<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Chambres et Suites</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  @include('frontend.styles')
</head>

<body>

  @include('frontend.header')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
      @if($room)
      <div class="row justify-content-between gy-5">
        <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
          <h2 data-aos="fade-up">{{$room->title}}</h2>
          <p data-aos="fade-up" data-aos-delay="100">{{$room->description}}</p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('eden-garden-resort')}}#book-a-table" class="btn-book-a-table">Reserver</a>
            <a href="https://www.youtube.com/watch?v=jMADnICNj60&t=86s" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Regarder Video</span></a>
          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
          <img src="{{ asset('storage/rooms')}}/{{ $room->image }}" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>
      @endif
    </div>
  </section>


    <section id="menu" class="menu">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Nos Chambres et Suites</h2>
          <p>Eden Garden Resort offre un logement relaxant sur les rives du Lac Tanganyika, dans un cadre naturel et verdoyant, à moins de 5 km de l’aéroport et du centre-ville.</p>
        </div>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="300">

          <div class="tab-pane fade active show" id="">

            <div class="row gy-5">
              @foreach($rooms as $room)
              <div class="col-lg-4 menu-item">
                <a href="{{ asset('storage/rooms')}}/{{ $room->image}}" class="glightbox"><img src="{{ asset('storage/rooms')}}/{{ $room->image}}" class="menu-img img-fluid" alt=""></a>
                <h4>{{ $room->title }}</h4>
                <p class="ingredients">
                  {{ $room->description}}
                </p>
                <p class="price">
                  {{ number_format($room->price,0,',',' ') }} fbu
                </p>
              </div><!-- Menu Item -->
              @endforeach
              {{$rooms->links()}}
            </div>
             
          </div><!-- End Starter Menu Content -->
        </div>
        
      </div>
    </section>

  @include('frontend.footer')

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  @include('frontend.scripts')

</body>

</html>