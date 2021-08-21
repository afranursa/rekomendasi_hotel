@extends('user.master')
@section('content')

<section class="hero-wrap hero-wrap-2" style="background-image: url({{Storage::url($hotel->gambar_hotel)}});" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-end justify-content-center">
        <div class="col-md-9 ftco-animate pb-5 text-center">
          <h1 class="mb-3 bread">{{$hotel->nama_hotel}}</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="/user/home">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="#">Detail Hotel <i class="ion-ios-arrow-forward"></i></a></span> <span>{{$hotel->nama_hotel}}<i class="ion-ios-arrow-forward"></i></span></p>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-degree-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 ftco-animate">
            <p>
            <img src="{{Storage::url($hotel->gambar_hotel)}}" alt="" class="img-fluid">
          </p>
          <h2 class="mb-3">{{$hotel->nama_hotel}}</h2>
          <span class="badge badge-pill badge-primary">{{$hotel->jenis_hotel}}</span>
          <p>
            {!!$hotel->deskripsi!!}
          </p>
          {{-- <div class="tag-widget post-tag-container mb-5 mt-5">
            <div class="tagcloud">
              <a href="#" class="tag-cloud-link">Life</a>
              <a href="#" class="tag-cloud-link">Sport</a>
              <a href="#" class="tag-cloud-link">Tech</a>
              <a href="#" class="tag-cloud-link">Travel</a>
            </div>
          </div> --}}

          {{-- <div class="about-author d-flex p-4 bg-light">
            <div class="bio mr-5">
              <img src="/usertemplate/images/person_1.jpg" alt="Image placeholder" class="img-fluid mb-4">
            </div>
            <div class="desc">
              <h3>George Washington</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
            </div>
          </div> --}}



        </div> <!-- .col-md-8 -->
        <div class="col-lg-4 sidebar ftco-animate">
          <div class="sidebar-box">
            <form action="#" class="search-form">
              <div class="form-group">
                <span class="icon icon-search"></span>
                <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
              </div>
            </form>
          </div>
          {{-- <div class="sidebar-box ftco-animate">
            <div class="categories">
              <h3>Categories</h3>
              <li><a href="#">Family Law <span class="ion-ios-arrow-forward"></span></a></li>
              <li><a href="#">Business Law <span class="ion-ios-arrow-forward"></span></a></li>
              <li><a href="#">Criminal Law <span class="ion-ios-arrow-forward"></span></a></li>
              <li><a href="#">Insurance Law <span class="ion-ios-arrow-forward"></span></a></li>
              <li><a href="#">Emloyment Law <span class="ion-ios-arrow-forward"></span></a></li>
              <li><a href="#">Property Law <span class="ion-ios-arrow-forward"></span></a></li>
            </div>
          </div> --}}
        </div>

      </div>
    </div>
  </section> <!-- .section -->
