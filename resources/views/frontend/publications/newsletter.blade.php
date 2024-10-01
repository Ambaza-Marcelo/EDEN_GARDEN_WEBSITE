<!doctype html>
<html lang="en">
  <head>
    <title>NEWSLETTER</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    @include('frontend.styles')
    
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    @include('frontend.header')

    <section class="site-section" id="about-section">
      <div class="row mb-5 justify-content-center">
          <div class="col-md-8 text-center">
            <h2 class="section-title mb-3">
            NEWSLETTER</h2>
            <p class="lead"></p>
          </div>
        </div>
        <div class="row">
              <div class="col-md-4" data-aos-delay="">
                <div>
                  <img src="{{ asset('frontend/images/corilac.png')}}" width="400">
                </div>
                <br>
                <div>
                  <a href="" class="btn btn-primary">TELECHARGER NEWSLETTER No 001/OCT-NOV 2022</a>
                </div>
              </div>
              <div class="col-md-4" data-aos-delay="">
                <div>
                  <img src="{{ asset('frontend/images/corilac.png')}}" width="400">
                </div>
                <br>
                <div>
                    <a href="" class="btn btn-primary">TELECHARGER NEWSLETTER No 002/DEC 2022</a>
                  </div>
              </div>
              <div class="col-md-4" data-aos-delay="">
                <div>
                  <img src="{{ asset('frontend/images/corilac.png')}}" width="400">
                </div>
                <br>
                <div>
                    <a href="" class="btn btn-primary">TELECHARGER NEWSLETTER No 002/DEC 2022</a>
                  </div>
              </div>

      </div>       
    </section>
    @include('frontend.footer')

  @include('frontend.scripts')

  
  </body>
</html>