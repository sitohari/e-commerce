@extends('layouts.dashboard')

@section('title')
    MyStore - Dashboard Setting Store
@endsection

@section('content')
<div
class="section-content section-dashboard-home"
data-aos="fade-up"
>
<div class="container-fluid">
  <div class="dashboard-heading">
    <h2 class="dashboard-title">Store Settings</h2>
    <p class="dashboard-subtitle">
      Make store that profitable
    </p>
  </div>
  <div class="dashboard-content">
    <div class="row">
      <div class="col-12">
        <form action="{{ route('dashboard-settings-redirect', 'dashboard-settings-store')}}" method="POST" enctype="multipart/form-data" id="locations">
          @csrf
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Store Name</label>
                    <input
                      type="text"
                      class="form-control"
                      name="store_name"
                      value="{{ $user->store_name}}"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Category</label>
                    <select name="categories_id" class="form-control">
                      <option value="{{ $user->categories_id }}">Tidak Diganti</option>
                      @foreach ($categories as $categories)
                        <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="is_store_open">Store Status</label>
                    <p class="text-muted">
                      Apakah saat ini toko Anda buka?
                    </p>
                    <div
                      class="custom-control custom-radio custom-control-inline"
                    >
                      <input
                        class="custom-control-input"
                        type="radio"
                        name="store_status" 
                        value="1"
                        {{ $user->store_status == 1 ? 'checked' : '' }}
                      />
                      <label
                        class="custom-control-label"
                        for="openStoreTrue"
                        >Buka</label
                      >
                    </div>
                    <div
                      class="custom-control custom-radio custom-control-inline"
                    >
                      <input
                        class="custom-control-input"
                        type="radio"
                        name="store_status "
                        id="openStoreFalse"
                        value="0"
                        {{ $user->store_status == 0 ||  $user->store_status == NULL  ? 'checked' : '' }}
                      />
                      <label
                        makasih
                        class="custom-control-label"
                        for="openStoreFalse"
                        >Tutup Sementara</label
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col text-right">
                  <button
                    type="submit"
                    class="btn btn-success px-5"
                  >
                    Save Now
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endsection


@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <script>
      var locations = new Vue({
        el: "#locations",
        mounted() {
          AOS.init();
          this.getProvincesData();
        },
        data: {
          provinces: null,
          regencies: null,
          provinces_id: null,
          regencies_id: null,
        },
        methods: {
          getProvincesData() {
            var self = this;
            axios.get('{{ route('api-provinces') }}')
              .then(function (response) {
                  self.provinces = response.data;
              })
          },
          getRegenciesData() {
            var self = this;
             axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
              .then(function (response) {
                  self.regencies = response.data;
              })
          },
        },
        watch: {
          provinces_id: function(val, oldVal){
            this.regencies_id = null;
            this.getRegenciesData();
          }
        }
      });
    </script>
@endpush