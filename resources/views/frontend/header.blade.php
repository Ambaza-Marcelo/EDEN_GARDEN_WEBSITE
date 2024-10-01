
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="" class="logo d-flex align-items-center me-auto me-lg-0">
        <h1><img src="{{ asset('frontend/assets/img/eden_logo.png')}}" /><span></span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li class="dropdown"><a href="{{ route('eden-garden-resort')}}"><span>Hotel</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="{{ route('site.rooms') }}">Chambres et Suites</a></li>
              <li><a href="">Infrastructures</a></li>
              <li><a href="{{ route('eden-garden-resort')}}#gallery">Gallerie</a></li>
              <li><a href="{{ route('site.salle') }}">Salles de Conferences</a></li>
              <li><a href="#">Certification</a></li>
            </ul>
          </li>
          <li><a href="{{ route('eden-garden-resort')}}#about">A Propos</a></li>
          <li><a href="{{ route('eden-garden-resort')}}#menu">Restauration</a></li>
          <li><a href="{{ route('eden-garden-resort')}}#events">Conferences et Evenements</a></li>
          <li><a href="{{ route('eden-garden-resort')}}#chefs">Chefs</a></li>
          <li class="dropdown"><a href="{{ route('eden-garden-resort')}}"><span>Publications</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="#">Actualités</a></li>
              <li><a href="#">NewsLetter</a></li>
              <li><a href="#">Appels d'Offres</a></li>
            </ul>
          </li>
          <li><a href="{{ route('eden-garden-resort')}}#contact">Contact</a></li>
          <li><a href="https://mamba.afriregister.com:2096/" target="_blank">Webmail</a></li>
        </ul>
      </nav>

      <a class="btn-book-a-table" href="#book-a-table">Réservation</a>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header>
