@extends('user.master')
@section('active3', 'active')
@section('content')

<section class="hero-wrap hero-wrap-2" style="background-image: url('/usertemplate/images/dark.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
        <h1 class="mb-3 bread">Riwayat Rating Pengguna</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="blog.html">Riwayat Rating Pengguna <i class="ion-ios-arrow-forward"></i></a></span></p>
      </div>
    </div>
  </div>
</section>

<input id="usernameuser" value="{{$username}}" hidden>

<section class="ftco-section bg-light">
  <div class="container">
    <div class="row d-flex" id="hotels">
    </div>
  </div>
</section>

@push('script')
<script>
    ownRatedHotel();

	function ownRatedHotel(){
        let username = document.getElementById('usernameuser').value;
        console.log(username);

        $.ajax({
            url: "/api/own-rated-hotel",
            type: "POST",
            data : {
                "username": username
            },
            dataType: "json",
            success: function(res) {
                let hotels = $('#hotels');
                let hotel = res;
                console.log(hotel);
                hotels.empty();
                for (let i=0; i<hotel.length; i++) {
                    $.ajax({
                        url: "/api/showother",
                        type: "POST",
                        data : {
                            "gambar_hotel": hotel[i].gambar_hotel,
                            "id_hotel": hotel[i].id_hotel
                        },
                        dataType: "json",
                        success: function(res) {
                            console.log(res);
                            let rating = res.rating.toFixed(2);
                            let html = `
                            <div class="col-md-4 d-flex">
                                <div class="blog-entry">
                                <img class="block-20" width="100px" height="50px" src="${res.gambar}">
                                <div class="text p-4 float-right d-block">
                                    <div class="topper d-flex align-items-center">
                                        <div class="one py-2 pl-3 pr-1 align-self-stretch">
                                            <span style="color: white">${rating}</span>
                                        </div>
                                        <div class="two pl-0 pr-3 py-2 align-self-stretch">
                                            <img src="">
                                        </div>
                                    </div>
                                    <h3 class="heading mt-2"><a href="/user/hotel/${hotel[i].id_hotel}">${hotel[i].nama_hotel}</a></h3>
                                    <p>${hotel[i].deskripsi}</p>
                                </div>
                                </div>
                            </div>
                            `
                            hotels.append(html);
                        }
                    });
                }
            }
        })
	}
</script>
@endpush
@endsection


