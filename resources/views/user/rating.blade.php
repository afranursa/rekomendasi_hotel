@extends('user.master')
@section('content')

<section class="ftco-consultation ftco-section img" style="background-image: url(/usertemplate/images/hotel2.jpg);">
    <div class="overlay"></div>
<div class="container">
    <div class="row d-md-flex justify-content-end">
        <div class="col-md-6 half p-3 p-md-5 ftco-animate heading-section">
            <span class="subheading">Silahkan isi Rating untuk Hotel</span>
            <h2 class="mb-4">Formulir Rating</h2>
            <form action="#" class="consultation">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Nama">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Subject">
        </div>
        <div class="form-group">
          <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
        </div>
        <div class="form-group">
          <input type="submit" value="Send message" class="btn btn-primary py-3 px-4">
        </div>
      </form>
        </div>
    </div>
</div>
</section>