<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;

use Exception;

use Midtrans\Config;
use Midtrans\Snap;

class CheckOutController extends Controller
{
    public function process(Request $request)
    {
        // TODO: Save users data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // Proses checkout
        $code = 'STORE-' . mt_rand(0000000,9999999);
        $carts = Cart::with(['product','user'])
                    ->where('users_id', Auth::user()->id)
                    ->get();

        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(0000000,9999999);

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx
            ]);
        }

        // Konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');
        
        // Delete Cart
        Cart::where('users_id', Auth::user()->id)->delete();


        // Buat array kirim ke midtrans
        $midtrans = [
            'transaction_details' => [ 
                'order_id' =>  $code,
                'gross_amount' => (int) $request->total_price,
            ],
            'costomer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'enabled_payments' => [
                'gopay', 'bank_transfer',
            ],
            'vtweb' => []
        ];

        try {
            // Ambil halaman payment midtrans
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Redirect ke halaman midtrans
            return redirect($paymentUrl);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function callback(Request $request)
    {

    }
}

