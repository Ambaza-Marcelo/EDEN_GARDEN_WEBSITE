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

  <section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
      @if($infrastructure)
      <div class="row justify-content-between gy-5">
        <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
          <h2 data-aos="fade-up">{{ $infrastructure->title }}</h2>
          <p data-aos="fade-up" data-aos-delay="100">{{ $infrastructure->description }}</p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="https://www.youtube.com/watch?v=ijAyLLZLHFM" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Regarder Video</span></a>
          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
          <img src="{{ asset('storage/infrastructure')}}/{{ $infrastructure->image }}" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>
      @endif
    </div>
  </section>

    <section id="menu" class="menu">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Nos Infrastructures</h2>
          <p>Regarder <span>Nos Infrastructures</span></p>
        </div>

        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">

          <li class="nav-item">
            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-starters">
              <h4>Infrastructures</h4>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-breakfast">
              <h4>Paillotes</h4>
            </a>

        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="300">

          <div class="tab-pane fade active show" id="menu-starters">

            <div class="tab-header text-center">
              <p>Menu</p>
              <h3>Paillotes</h3>
            </div>

            <div class="row gy-5">

              <div class="col-lg-4 menu-item">
                <a href="{{ asset('frontend/assets/img/gallery/eden.png')}}" class="glightbox"><img src="{{ asset('frontend/assets/img/gallery/eden.png')}}" class="menu-img img-fluid" alt=""></a>
                <h4>Eden Garden Resort</h4>
                <p class="ingredients">
                  Eden garden Resort
                </p>
                <p class="price">
                  10 000 fbu
                </p>
              </div>

              <div class="col-lg-4 menu-item">
                <a href="{{ asset('frontend/assets/img/gallery/eden.png')}}" class="glightbox"><img src="{{ asset('frontend/assets/img/gallery/eden.png')}}" class="menu-img img-fluid" alt=""></a>
                <h4>Eden Garden Resort</h4>
                <p class="ingredients">
                  Eden garden Resort
                </p>
                <p class="price">
                  10 000 fbu
                </p>
              </div>

              <div class="col-lg-4 menu-item">
                <a href="{{ asset('frontend/assets/img/gallery/eden.png')}}" class="glightbox"><img src="{{ asset('frontend/assets/img/gallery/eden.png')}}" class="menu-img img-fluid" alt=""></a>
                <h4>Eden Garden Resort</h4>
                <p class="ingredients">
                  Eden garden Resort
                </p>
                <p class="price">
                  10 000 fbu
                </p>
              </div>

              <div class="col-lg-4 menu-item">
                <a href="{{ asset('frontend/assets/img/gallery/eden.png')}}" class="glightbox"><img src="{{ asset('frontend/assets/img/gallery/eden.png')}}" class="menu-img img-fluid" alt=""></a>
                <h4>Eden Garden Resort</h4>
                <p class="ingredients">
                  Eden garden Resort
                </p>
                <p class="price">
                  10 000 fbu
                </p>
              </div>

            </div>
          </div>

          <div class="tab-pane fade" id="menu-breakfast">

            <div class="tab-header text-center">
              <p>Infrastructure</p>
              <h3>Paillotes</h3>
            </div>

            <div class="row gy-5">
              @foreach($infrastructures as $infrastructure)
              <div class="col-lg-4 menu-item">
                <a href="{{ asset('storage/infrastructure')}}/{{ $infrastructure->image }}" class="glightbox"><img src="{{ asset('storage/infrastructure')}}/{{ $infrastructure->image }}" class="menu-img img-fluid" alt=""></a>
                <h4>{{$infrastructure->title}}</h4>
                <p class="ingredients">
                  {{$infrastructure->description}}
                </p>
              </div>
              @endforeach

            </div>
          </div>
        </div>

      </div>
    </section>

    
    <!-- ======= Book A Table Section ======= -->
    <section id="book-a-table" class="book-a-table">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Reserver Table</h2>
          <p>Reservez Votre Table</p>
        </div>

        <div class="row g-0">

          <div class="col-lg-4 reservation-img" style="background-image: url({{ asset('frontend/assets/img/reservation.jpg')}});" data-aos="zoom-out" data-aos-delay="200"></div>

          <div class="col-lg-8 d-flex align-items-center reservation-form-bg">
            <form action="#" method="post" role="form" class="php-email-form" data-aos="fade-up" data-aos-delay="100">
              <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Saisir Votre Nom" data-rule="minlen:4" data-msg="Veuillez Saisir Votre Nom">
                  <div class="validate"></div>
                </div>
                <div class="col-lg-4 col-md-6">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Saisir Votre E-mail" data-rule="email" data-msg="Veuillez Saisir E-mail qui est Valide">
                  <div class="validate"></div>
                </div>
                <div class="col-lg-4 col-md-6">
                  <input type="text" class="form-control" name="phone" id="phone" placeholder="Saisir Votre Numero Telephone" data-rule="minlen:4" data-msg="Veuillez Saisir Votre Numero Telephone">
                  <div class="validate"></div>
                </div>
                <div class="col-lg-4 col-md-6">
                  <input type="date" name="date" class="form-control" id="date" data-rule="minlen:4" data-msg="Choisir Date qui est correcte">
                  <div class="validate"></div>
                </div>
                <div class="col-lg-4 col-md-6">
                  <input type="time" class="form-control" name="time" id="time" data-rule="minlen:4" data-msg="Veuillez Choisir Le Temps Correct">
                  <div class="validate"></div>
                </div>
                <div class="col-lg-4 col-md-6">
                  <input type="number" class="form-control" name="people" id="people" placeholder="Saisir Le nombre de Personnes" data-rule="minlen:1" data-msg="Veuillez Saisir Le nombre de Personnes">
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Saisir Votre Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your booking request was sent. We will call back or send an Email to confirm your reservation. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Reserver Une Table</button></div>
            </form>
          </div>

        </div>

      </div>
    </section>

    <section id="gallery" class="gallery section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Images</h2>
          <p>Images</span></p>
        </div>

        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center">
            @foreach($infrastructures as $infrastructure)
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="{{ asset('storage/infrastructure')}}/{{ $infrastructure->image }}"><img src="{{ asset('storage/infrastructure')}}/{{ $infrastructure->image }}" class="img-fluid" alt=""></a>
            </div>
            @endforeach
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section>

  @include('frontend.footer')

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  @include('frontend.scripts')

</body>

</html>