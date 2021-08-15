@extends('user.master')
@section('content')

<section class="ftco-consultation ftco-section img" style="background-image: url(/usertemplate/images/dark.jpg);">
    <div class="overlay"></div>
    
    <div class="container">
        <div class="row d-md-flex justify-content-end">
            <div class="col-md-6 half p-3 p-md-5 ftco-animate heading-section">
              <div class="card">
                <div class="card-body">
                <span class="subheading">Silahkan isi Rating untuk Hotel</span>
                <h2 class="mb-4"><p style="color: rgb(0, 0, 0)">Formulir Rating</p></h2>
                <form action="#" class="consultation">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Nama">
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1"></label>
              <p style="color: rgb(0, 0, 0)"><b>Pilih Hotel</b></p>
              <select class="form-control js-example-basic-single" id="exampleFormControlSelect1">
                <option>Amaris</option>
                <option>Luxton</option>
              </select>
            </div>

              <label for="customRange1" class="form-label"><p style="color:rgb(0, 0, 0)"><b>Rating Fasilitas Hotel</b></p></label>
              <input type="range" class="form-range" min="0" max="5" id="customRange2">
            <div class="form-group">
              <label for="exampleFormControlSelect1"></label>

              <label for="customRange2" class="form-label"><p style="color: rgb(0, 0, 0)"><b>Rating Kenyamanan Hotel</b></p></label>
              <input type="range" class="form-range" min="0" max="5" id="customRange2">
            <div class="form-group">
              <label for="exampleFormControlSelect2"></label>

              <label for="customRange3" class="form-label"><p style="color: rgb(0, 0, 0)"><b>Rating Harga Hotel</b></p></label>
              <input type="range" class="form-range" min="0" max="5" id="customRange2">
            <div class="form-group">
              <label for="exampleFormControlSelect3"></label>

              <label for="customRange4" class="form-label"><p style="color: rgb(0, 0, 0)"><b>Rating Strategis Letak Hotel</b></p></label>
              <input type="range" class="form-range" min="0" max="5" id="customRange2">
              
            <div class="form-group">
              <label for="exampleFormControlSelect4"></label>
            <div class="form-group">
              <input type="submit" value="Submit" class="btn btn-primary py-3 px-4">
            </div>
          
@push('script')
  <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script> 
  // In your Javascript (external .js resource or <script> tag)
      $('.js-example-basic-single').select2();
    
  </script>
@endpush
</section>