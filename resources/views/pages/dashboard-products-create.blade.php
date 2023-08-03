@extends('layouts.dashboard')

@section('title')
    MyStore - Dashboard Product Create
@endsection

@section('content')
<div
class="section-content section-dashboard-home"
data-aos="fade-up"
>
<div class="container-fluid">
  <div class="dashboard-heading">
    <h2 class="dashboard-title">Add New Product</h2>
    <p class="dashboard-subtitle">
      Create your own product
    </p>
  </div>
  <div class="dashboard-content">
    <div class="row">
      <div class="col-12">
        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
        <form action="{{route('dashboard-products-store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Product Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      aria-describedby="name"
                      name="name"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="price">Price</label>
                    <input
                      type="number"
                      class="form-control"
                      id="price"
                      aria-describedby="price"
                      name="price"
                    />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Kategori</label>
                    <select name="categories_id" class="form-control">
                      @foreach ($categories as $categories)
                        <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea
                      name="description"
                      class="form-control"
                      id="editor"
                    >
                    </textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="thumbnails">Thumbnails</label>
                    <input
                      type="file"
                      class="form-control pt-1"
                      name="photo"
                    />
                    <small class="text-muted">
                      Kamu dapat memilih lebih dari satu file
                    </small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col">
              <button
                type="submit"
                class="btn btn-success btn-block px-5"
              >
                Save Now
              </button>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
     <script>
                        ClassicEditor
                                .create( document.querySelector( '#editor' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
                </script>
@endpush