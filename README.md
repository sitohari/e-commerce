#    Project MyTOKO
Di buat oleh Mohaamad Tohari Maolana

---

## Dev Environment Setup
1. Laravel 
  Version [8.x](https:https://laravel.com/)
2. Composer 
  Version [2.5.4](https:https://getcomposer.org/)
3. PHP
  Php version [7.4.33](https:https://www.php.net/)
4. XAMPP
  Version [3.3.0](https:https://www.apachefriends.org/)
6. Visual Studi Code 
 Code Editor https://code.visualstudio.com

## Database
### Analisis Database

#### User
1. Nama
2. Email
3. Password
4. Alamat 1
5. Alamat 2
6. Provinsi https://github.com/azishapidin/indoregion
7. Kota  https://github.com/azishapidin/indoregion
8. Kode Pos
9. Negara
10. Nomor Handphone
11. Nama Toko
12. Kategori Toko
13. Status Toko

#### Produk
1. Nama Produk
2. Relasi ke pemilik produk
3. Harga Produk
4. Deskripsi
5. Kategori Produk

#### Kategori 
1. Kategori
2. Nama Kategori
3. Slug(mytoko/kategori/fashion)

#### Cart
1. Relasi ke Product
2. Relasi ke User

#### Galeri Produk
1.  Foto
2.  Relasi ke Produk

#### Transaksi
1. Relasi ke User
2. Jumlah Asuransi
3. Ongkir
4. Total
5. Status Transaksi
6. Nomor Resi

#### Transaksi Detail
1. Relasi ke Transaksi
2. Relasi ke Produk
3. Harga Produk

## Entity Relationship Diagram
![](https://github.com/sitohari/mytoko/blob/main/public/images/Screenshot%202023-10-15%20185838.png)

---
## Mockup
![](https://github.com/sitohari/mytoko/blob/main/public/images/discovermytoko.png)

