@extends('user.master')
@section('active2', 'active')
@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('/usertemplate/images/dark.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-end justify-content-center">
        <div class="col-md-9 ftco-animate pb-5 text-center">
          <h1 class="mb-3 bread">Rating</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="blog.html">Rating <i class="ion-ios-arrow-forward"></i></a></span></p>
        </div>
      </div>
    </div>
</section>
<section class="ftco-consultation ftco-section img" style="background-image: url(/usertemplate/images/bg_2.jpg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row d-md-flex justify-content-end">
            <div class="col-md-6 half p-3 p-md-5 ftco-animate heading-section">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">Rating Hotel</h2>
                        <span class="subheading">Silahkan merating hotel!</span>
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(Session::has('alert-danger'))
                            <div class="alert alert-danger">
                                <div>{{Session::get('alert-danger')}}</div>
                            </div>
                        @endif
                        @if(Session::has('alert-success'))
                            <div class="alert alert-success">
                                <div>{{Session::get('alert-success')}}</div>
                            </div>
                        @endif
                        <form action="/user/rating/add" method="POST" class="consultation">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="Username" value="{{$username}}" readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{$nama}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Pilih Hotel</label>
                                <select class="form-control js-example-basic-single" name="hotel" id="exampleFormControlSelect1" required>
                                    <option value=" ">--- Pilih Hotel ---</option>
                                    @foreach ($hotel as $htl)
                                        <option value="{{$htl->id_hotel}}">{{$htl->nama_hotel}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="customRange1" class="form-label">Rating Fasilitas Hotel</label>
                                <input type="range" class="form-control form-range" min="1" max="5" id="customRange1" name="fasilitas">
                            </div>
                            <div class="form-group">
                                <label for="customRange2" class="form-label">Rating Kenyamanan Hotel</label>
                                <input type="range" class="form-control form-range" min="1" max="5" id="customRange2" name="kenyamanan">
                            </div>
                            <div class="form-group">
                                <label for="customRange3" class="form-label">Rating Harga Hotel</label>
                                <input type="range" class="form-control form-range" min="1" max="5" id="customRange3" name="harga">
                            </div>
                            <div class="form-group">
                                <label for="customRange4" class="form-label">Rating Strategis Letak Hotel</label>
                                <input type="range" class="form-control form-range" min="1" max="5" id="customRange4" name="letak">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Selesai" class="btn btn-primary py-3 px-4">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('script')
  <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
  // In your Javascript (external .js resource or <script> tag)
      $('.js-example-basic-single').select2();

  </script>
@endpush
</section>
