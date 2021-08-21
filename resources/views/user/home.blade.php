@extends('user.master')
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

	<section class="ftco-section ftco-no-pt ftco-no-pb bg-primary">
		<div class="container py-4">
		  <div class="row d-flex justify-content-center">
			<div class="col-md-7 ftco-animate d-flex align-items-center">
			  <h2 class="mb-0" style="color:white; font-size: 28px;">Pilih hotel sesukamu</h2>
			</div>
			<div class="col-md-5 d-flex align-items-center">
			  <form action="#" class="subscribe-form">
				<div class="form-group d-flex">
				  <input type="text" class="form-control" placeholder="Nama Hotel atau Kota">
				  <input type="submit" value="Search" class="submit px-3">
				</div>
			  </form>
			</div>
		  </div>
		</div>
	  </section>

	<section class="ftco-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Data</span>
            <h2>Hotel</h2>
          </div>
        </div>
        <div class="row d-flex" id="hotels">
        </div>
      </div>
	  {{-- <div class="container">
        <div class="row d-flex">
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <a href="blog-single.html" class="block-20" style="background-image: url('usertemplate/images/AMARIS.jpg');">
              </a>
              <div class="text p-4 float-right d-block">
              	<div class="topper d-flex align-items-center">
              		<div class="one py-2 pl-3 pr-1 align-self-stretch">
              			<span class="day">15</span>
              		</div>
              		<div class="two pl-0 pr-3 py-2 align-self-stretch">
              			<span class="yr">Hotel</span>
              			<span class="mos">Amaris</span>
              		</div>
              	</div>
                <h3 class="heading mt-2"><a href="#">All you want to know about industrial laws</a></h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <a href="blog-single.html" class="block-20" style="background-image: url('usertemplate/images/BATIQA.jpg');">
              </a>
              <div class="text p-4 float-right d-block">
              	<div class="topper d-flex align-items-center">
              		<div class="one py-2 pl-3 pr-1 align-self-stretch">
              			<span class="day">12</span>
              		</div>
              		<div class="two pl-0 pr-3 py-2 align-self-stretch">
              			<span class="yr">Hotel</span>
              			<span class="mos">Batiqa</span>
              		</div>
              	</div>
                <h3 class="heading mt-2"><a href="#">All you want to know about industrial laws</a></h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
    </section>

@push('script')
<script>
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
				});
			},function error(msg) {
				alert('Please enable your GPS position feature.');
			}, {timeout:10000});
		}else{
			alert("Geolocation API is not supported in your browser.");
		}
	}

</script>
@endpush
@endsection
