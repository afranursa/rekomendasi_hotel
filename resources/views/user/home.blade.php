@extends('user.master')
@section('active1', 'active')
@section('content')

<div class="hero-wrap js-fullheight" style="background-image: url('/usertemplate/images/dark.jpg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
      <div class="container-fluid px-md-5">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-6 ftco-animate">
          	<h2 class="subheading">Hai {{$nama}}</h2>
            <h1 class="mb-4">Saat ini anda berada di <b><div id="kota"></div></b></h1>
			<input id="usernameuser" value="{{$username}}" hidden>
          </div>
        </div>
      </div>
</div>

<section class="ftco-section ftco-no-pt ftco-no-pb bg-primary">
    <div class="container py-4">
        <div class="row d-flex justify-content-center">
        <div class="col-md-7 ftco-animate d-flex align-items-center">
            <h2 class="mb-0" style="color:white; font-size: 28px;">Pilih hotel sesukamu</h2>
        </div>
        <div class="col-md-5 d-flex align-items-center">
            <div class="form-group d-flex">
                <input type="text" class="form-control" id="search-hotel" placeholder="Cari hotel atau kota">
                <button onclick="searchHotel()" value="Search" class="submit px-3">Search</button>
            </div>
        </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container" id="search-result">
        <div class="alert alert-warning" id="alert"></div>
        <div class="row d-flex" id="hotels-search">
    </div>
    </div>
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <h2>Rekomendasi hotel</h2>
            </div>
        </div>
        <div class="row d-flex" id="hotels">
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <h2>Hotel di sekitar Anda</h2>
            </div>
        </div>
        <div class="row d-flex" id="hotels-in-city">
        </div>
    </div>
</section>

@push('script')
<script>
    let searchResult = document.getElementById('search-result');
    searchResult.style.visibility = 'Hidden';
    hotelInCity();
	getLocation();

	function getLocation(){
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function () {}, function () {}, {});

			navigator.geolocation.getCurrentPosition(function(location) {
				$.ajax({
					url: "https://dataservice.accuweather.com/locations/v1/cities/geoposition/search",
					type:"GET",
					data : {
						"apikey": "boCFKdy0IAYZh7p68IHY3VTZsB3oGoZG",
						"q": location.coords.latitude+","+location.coords.longitude,
						"language": "en-us",
						"details": false,
						"toplevel":false
					},
					dataType: "json",
					success: function(res){
						location = res.SupplementalAdminAreas[0].LocalizedName;
						document.getElementById('kota').innerHTML = location;
						console.log(location);
						let username = document.getElementById('usernameuser').value;
						console.log(username);

						$.ajax({
							url: "/api/hotel-rec",
							type: "POST",
							data : {
								"city": location,
								"username": username
							},
							dataType: "json",
							success: function(res) {
								let hotels = $('#hotels');
								let hotel = res.hotel_rec;
								console.log(res);
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
				});
			},function error(msg) {
				alert('Please enable your GPS position feature.');
			}, {timeout:10000});
		}else{
			alert("Geolocation API is not supported in your browser.");
		}
	}

    function hotelInCity(){
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function () {}, function () {}, {});

			navigator.geolocation.getCurrentPosition(function(location) {
				$.ajax({
					url: "https://dataservice.accuweather.com/locations/v1/cities/geoposition/search",
					type:"GET",
					data : {
						"apikey": "boCFKdy0IAYZh7p68IHY3VTZsB3oGoZG",
						"q": location.coords.latitude+","+location.coords.longitude,
						"language": "en-us",
						"details": false,
						"toplevel":false
					},
					dataType: "json",
					success: function(res){
						location = res.SupplementalAdminAreas[0].LocalizedName;
						$.ajax({
							url: "/api/hotel-in-city",
							type: "POST",
							data : {
								"city": location
							},
							dataType: "json",
							success: function(res) {
								let hotels = $('#hotels-in-city');
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
						});
					}
				});
			},function error(msg) {
				alert('Please enable your GPS position feature.');
			}, {timeout:10000});
		}else{
			alert("Geolocation API is not supported in your browser.");
		}
	}

    function searchHotel(){
        let query = document.getElementById('search-hotel').value;
        $.ajax({
            url: "/api/search-hotel",
            type: "POST",
            data : {
                "search": query
            },
            dataType: "json",
            success: function(res) {
                let hotels = $('#hotels-search');
                let hotel = res;
                console.log(hotel);

                if(hotel.length < 1){
                    searchResult.style.visibility = 'visible';
                    document.getElementById('alert').innerHTML = 'Tidak ada data';
                }

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
                            document.getElementById('alert').innerHTML = 'Data ditemukan';
                            searchResult.style.visibility = 'visible';
                        }
                    });
                }
            }
        });
    }

</script>
@endpush
@endsection
