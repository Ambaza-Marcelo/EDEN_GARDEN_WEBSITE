<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>EDEN GARDEN RESORT</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  @include('frontend.styles')
</head>

<body>
  @include('frontend.header')
  <section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
      @if($imageSlider)
      <div class="row justify-content-between gy-5">
        <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
          <h2 data-aos="fade-up">{{ $imageSlider->title }}<br>{{ $imageSlider->subtitle }}</h2>
          <p data-aos="fade-up" data-aos-delay="100">{{ $imageSlider->description }}.</p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="#book-a-table" class="btn-book-a-table">Reservation</a>
            <a href="https://www.youtube.com/watch?v=jMADnICNj60&t=86s" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Regarder Video</span></a>
          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
          <img src="{{ asset('storage/sliders')}}/{{ $imageSlider->image }}" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>
      @endif
    </div>
  </section>
  
  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>A propos de Nous</h2>
          <p>Savoir Plus<span> A propos de Nous</span></p>
        </div>
        @if($about)
        <div class="row gy-4">
          <div class="col-lg-7 position-relative about-img" style="background-image: url({{ asset('storage/abouts')}}/{{ $about->image }}) ;" data-aos="fade-up" data-aos-delay="150">
            <div class="call-us position-absolute">
              <h4>Reserver Table</h4>
              <p><a href="https://api.whatsapp.com/send?phone=79500500" target="_blank" class="nav-link">+257 79500500</a></p>
            </div>
          </div>
          <div class="col-lg-5 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300">
            <div class="content ps-0 ps-lg-5">
              <p class="fst-italic">
                {{ $about->description}}.
              </p>
              <ul>
                <li><i class="bi bi-check2-all"></i>{{ $about->subtitle }}</li>
              </ul>

              <div class="position-relative mt-4">
                <img src="{{ asset('storage/abouts')}}/{{ $about->image}}" class="img-fluid" alt="">
                <a href="https://www.youtube.com/watch?v=jMADnICNj60&t=86s" class="glightbox play-btn"></a>
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
    </section>

    <section id="why-us" class="why-us section-bg">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="why-box">
              <h3>Pourquoi Choisir Eden Garden Resort?</h3>
              <p>
                Eden Garden Resort *****, avec plusieurs salles pour Réunions et Conférences et différents appartements, est le plus grand complexe Restaurant au Burundi.
              </p>
              <div class="text-center">
                <a href="#" class="more-btn">Savoir Plus<i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-8 d-flex align-items-center">
            <div class="row gy-4">

              <div class="col-xl-4" data-aos="fade-up" data-aos-delay="200">
                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                  <img src="{{ asset('frontend/assets/img/undraw_festivities_tvvj.svg') }}" width="100">
                  <h4>Salles pour Réunions et Conférences</h4>
                  <p>Eden Garden Resort est doté de différentes salles pour réunions et conférences ainsi que plusieurs salles pour réceptions, cocktails et grands évènements, avec tous les équipements technologiques nécessaires.</p>
                </div>
              </div>

              <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                  <img src="{{ asset('frontend/assets/img/undraw_breakfast_psiw.svg') }}" width="100">
                  <h4>Les Restaurants et les Bars</h4>
                  <p>Les restaurants et les bars de l’Eden Garden Resort offrent une cuisine diversifiée et toujours savoureuse, idéale pour les petits désirs ainsi que les repas plus conviviaux.</p>
                </div>
              </div>

              <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                  <img src="{{ asset('frontend/assets/img/undraw_compose_music_re_wpiw.svg') }}" width="100">
                  <h4>Les Animations Musicales, les Evènements Culturels</h4>
                  <p>Les animations musicales, les évènements culturels, le Parking, les ascenseurs, la sauna et la salle de fitness sont enfin des raisons valables pour passer une agréable journée à côté du Lac Tanganyika.</p>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>
    </section>

    <section id="stats-counter" class="stats-counter">
      <div class="container" data-aos="zoom-out">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="{{$total_customers}}" data-purecounter-duration="1" class="purecounter"></span>
              <p>Clients</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="{{$total_salles}}" data-purecounter-duration="1" class="purecounter"></span>
              <p>Salles</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="{{$total_rooms}}" data-purecounter-duration="1" class="purecounter"></span>
              <p>Chambres/Suites</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="{{$total_teams}}" data-purecounter-duration="1" class="purecounter"></span>
              <p>Employés</p>
            </div>
          </div>

        </div>

      </div>
    </section>

    <section id="menu" class="menu">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Nos Menus</h2>
          <p>Eden Garden Resort offrent une cuisine diversifiée et toujours savoureuse, idéale pour les petits désirs ainsi que les repas plus conviviaux.</p>
        </div>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="300">

          <div class="tab-pane fade active show" id="">

            <div class="row gy-5">
              @foreach($restaurations as $restauration)
              <div class="col-lg-4 menu-item">
                <a href="{{ asset('storage/restauration')}}/{{ $restauration->image}}" class="glightbox"><img src="{{ asset('storage/restauration')}}/{{ $restauration->image}}" class="menu-img img-fluid" alt=""></a>
                <h4>{{ $restauration->title }}</h4>
                <p class="ingredients">
                  {{ $restauration->description}}
                </p>
                <p class="price">
                  {{ number_format($restauration->price,0,',',' ') }} fbu
                </p>
              </div><!-- Menu Item -->
              @endforeach
              {{$restaurations->links()}}
            </div>

          </div><!-- End Starter Menu Content -->
        </div>

      </div>
    </section>

    <section id="testimonials" class="testimonials section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Les Commentaires Positives</h2>
          <p>Quelques Commentaires Positives Qui Nous Encouragent</span></p>
        </div>

        <div class="slides-1 swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row gy-4 justify-content-center">
                  <div class="col-lg-6">
                    <div class="testimonial-content">
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        Eden Garden Resort est le plus grand complexe restaurant au Burundi.
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                      <h3>Eden Garden Resort</h3>
                      <h4>Restaurant et Bar</h4>
                      <div class="stars">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 text-center">
                    <img src="{{ asset('frontend/assets/img/stats-bg.jpg')}}" class="img-fluid testimonial-img" alt="">
                  </div>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row gy-4 justify-content-center">
                  <div class="col-lg-6">
                    <div class="testimonial-content">
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        Eden Garden Resort est le plus grand complexe restaurant au Burundi.
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                      <h3>Eden Garden Resort</h3>
                      <h4>Restaurant et Bar</h4>
                      <div class="stars">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 text-center">
                    <img src="{{ asset('frontend/assets/img/stats-bg.jpg')}}" class="img-fluid testimonial-img" alt="">
                  </div>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row gy-4 justify-content-center">
                  <div class="col-lg-6">
                    <div class="testimonial-content">
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        Eden Garden Resort est le plus grand complexe restaurant au Burundi.
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                      <h3>Eden Garden Resort</h3>
                      <h4>Restaurant et Bar</h4>
                      <div class="stars">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 text-center">
                    <img src="{{ asset('frontend/assets/img/gallery/eden.jpg')}}" class="img-fluid testimonial-img" alt="">
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section>


    <section id="events" class="events">
      <div class="container-fluid" data-aos="fade-up">

        <div class="section-header">
          <h2>Conférences et Événements</h2>
          <p>Conférences et Événements</p>
        </div>

        <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            @foreach($events as $event)
            <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url({{ asset('storage/events')}}/{{ $event->image }})">
              <h3>{{ $event->title }}</h3>
              <div class="price align-self-start">{{ number_format($event->price,0,',',' ') }} fbu</div>
              <p class="description">
                {{ $event->description }}
              </p>
            </div>
            @endforeach

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section>


    <section id="chefs" class="chefs section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Chefs de Cuisine</h2>
          <p>Nos <span>Profossionnels</span> Chefs de Cuisine</p>
        </div>

        <div class="row gy-4">
          @foreach($teams as $team)
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="chef-member">
              <div class="member-img">
                <img src="{{ asset('storage/team')}}/{{ $team->image }}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>{{ $team->position->name}}</h4>
                <span>{{ $team->name }}</span>
                <p>{{ $team->description}}</p>
              </div>
            </div>
          </div>
          @endforeach

        </div>

      </div>
    </section>

    <!-- ======= Book A Table Section ======= -->
    <section id="book-a-table" class="book-a-table">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Réservation</h2>
          <p>Réservation</p>
        </div>

        <div class="row g-0">

          <div class="col-lg-4 reservation-img" style="background-image: url({{ asset('frontend/assets/img/stats-bg.jpg')}});" data-aos="zoom-out" data-aos-delay="200"></div>

          <div class="col-lg-8 d-flex align-items-center reservation-form-bg">
            <form action="{{ route('admin.bookings.store') }}" method="post" role="form" class="php-email-form" data-aos="fade-up" data-aos-delay="100">
              @csrf
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
                  <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Saisir Votre Numero Telephone" data-rule="minlen:4" data-msg="Veuillez Saisir Votre Numero Telephone">
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
              </div>
              <br>

              <div class="row gy-4" id="dynamicSelect">
                <div class="col-lg-4 col-md-6">
                    <select id="service" class="form-control" name="service">
                        <option selected="selected" disabled="disabled">merci de choisir</option>
                        <option value="PAILLOTE" class="form-control">PAILLOTE</option>
                        <option value="SALLE" class="form-control">SALLE</option>
                        <option value="CHAMBRE" class="form-control">CHAMBRE</option>
                    </select>
                </div>
              </div>

              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Saisir Votre Message"></textarea>
                <div class="validate"></div>
              </div>
              @if (Session::has('success'))
                <div class="alert alert-success">
                  <div>
                    <p>{{ Session::get('success') }}</p>
                  </div>
                </div>
              @endif
              <div class="text-center"><button type="submit">Reserver</button></div>
            </form>
          </div>

        </div>

      </div>
    </section>

    <section id="gallery" class="gallery section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Gallerie</h2>
          <p>Gallerie</span></p>
        </div>

        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center">
            @foreach($pictures as $picture)
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="{{ asset('storage/gallerie')}}/{{ $picture->image }}"><img src="{{ asset('storage/gallerie')}}/{{ $picture->image }}" class="img-fluid" alt=""></a>
            </div>
            @endforeach
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section>

    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Contact</h2>
          <p>Avez-vous besoin d'Aide? <span>Contactez-nous</span></p>
        </div>

        

        <div class="mb-3">
          <div class="mapouter"><div class="gmap_canvas"><iframe  style="border:0; width: 100%; height: 350px;" id="gmap_canvas" src="https://maps.google.com/maps?q=bujumbura%20EDEN%20GARDEN%20RESORT&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://fmovies-online.net"></a><br><style>.mapouter{position:relative;text-align:right;height:350px;width:100%;}</style><a href="https://www.embedgooglemap.net">embedgooglemap.net</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:350px;width:100%;}</style></div></div>
        </div>

        <div class="row gy-4">

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-map flex-shrink-0"></i>
              <div>
                <h3>Notre Adresse</h3>
                <p>Chaussee D'Uvira, Bujumbura, Burundi</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item d-flex align-items-center">
              <i class="icon bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Notre E-mail</h3>
                <p>info@edengardenresorts.bi</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Notre Telephone</h3>
                <p>+257 79500500</p>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-share flex-shrink-0"></i>
              <div>
                <h3>Heures d'Ouverture</h3>
                <div><strong>LUNDI-DIMANCHE:</strong> 12AM - 23PM;
                </div>
              </div>
            </div>
          </div>

        </div>

        <form action="" method="post" role="form" class="php-email-form p-3 p-md-4">
          <div class="row">
            <div class="col-xl-6 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Saisir Votre Nom" required>
            </div>
            <div class="col-xl-6 form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="Saisir Votre E-mail" required>
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Saisir Sujet" required>
          </div>
          <div class="form-group">
            <textarea class="form-control" name="message" rows="5" placeholder="Saisir Votre Message" required></textarea>
          </div>
          <div class="my-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your message has been sent. Thank you!</div>
          </div>
          <div class="text-center"><button type="submit">Envoyer Le Message</button></div>
        </form>

      </div>
    </section>

  </main>

  @include('frontend.footer')

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  @include('frontend.scripts')

 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript">
    
    $('#service').change(function () { 
    if ($(this).val() === 'PAILLOTE'){
      var paillote = "<div class='form-group'>"+
                            "<label for='paillote_id'>PAILLOTE</label>"+
                            "<select class='form-control' name='paillote_id' id='paillote_id'>"+
                                "<option disabled='disabled' selected='selected'>Merci de Choisir</option>"+
                                "@foreach($paillotes as $paillote)"+
                                "<option value='{{ $paillote->id }}'>{{ $paillote->name }}</option>"+
                                "@endforeach"+
                            "</select>"+
                        "</div>";
        var ofpeople = "<div class='form-group'>"+
                            "<label for='ofpeople'>Nombre Personnes</label>"+
                            "<input type='number' class='form-control' id='ofpeople' name='ofpeople' placeholder='Nombre Personnes'>"+
                        "</div>";
        
        $("#dynamicSelect").append(paillote,ofpeople);
    }

    if ($(this).val() === 'SALLE'){
      var salle = "<div class='form-group'>"+
                            "<label for='salle_id'>SALLE</label>"+
                            "<select class='form-control' name='salle_id' id='salle_id'>"+
                                "<option disabled='disabled' selected='selected'>Merci de Choisir</option>"+
                                "@foreach($salles as $salle)"+
                                "<option value='{{ $salle->id }}'>{{ $salle->title }}/{{ number_format($salle->price,0,',',' ') }}</option>"+
                                "@endforeach"+
                            "</select>"+
                        "</div>";
        var ofpeople = "<div class='form-group'>"+
                            "<label for='ofpeople'>Nombre Personnes</label>"+
                            "<input type='number' class='form-control' id='ofpeople' name='ofpeople' placeholder='Nombre Personnes'>"+
                        "</div>";
        
        $("#dynamicSelect").append(salle,ofpeople);
    }

    if ($(this).val() === 'CHAMBRE'){
      var chambre = "<div class='form-group'>"+
                            "<label for='room_id'>CHAMBRE</label>"+
                            "<select class='form-control' name='room_id' id='room_id'>"+
                                "<option disabled='disabled' selected='selected'>Merci de Choisir</option>"+
                                "@foreach($rooms as $room)"+
                                "<option value='{{ $room->id }}'>{{ $room->title }}/{{ number_format($room->price,0,',',' ') }}</option>"+
                                "@endforeach"+
                            "</select>"+
                        "</div>";
        var ofpeople = "<div class='form-group'>"+
                            "<label for='ofpeople'>Nombre Personnes</label>"+
                            "<input type='number' class='form-control' id='ofpeople' name='ofpeople' placeholder='Nombre Personnes'>"+
                        "</div>";
        
        $("#dynamicSelect").append(chambre,ofpeople);
    }

    })
    .trigger( "change" );


</script>

</body>

</html>