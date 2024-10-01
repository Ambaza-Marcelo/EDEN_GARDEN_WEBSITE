<!doctype html>
<html lang="en">
  <head>
    <title>Dans L'Actualité</title>
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

    <section class="site-section container" id="about-section">
      <div class="row mb-5 justify-content-center">
          <div class="col-md-8 text-center">
            <h2 class="section-title mb-3">
            Dans L'Actualité</h2>
            <p class="lead"></p>
          </div>
        </div>
        <div class="row">
          @foreach($actualites as $actualite)
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos-delay="">
            <div class="h-entry">
              <a href="{{ route('site.actualite-show',$actualite->id)}}">
                <figure class="circle-bg">
                  <img src="{{ asset('storage/actualites')}}/{{$actualite->image}}" alt="Image" class="img-fluid">
                </figure>
              </a>
              <h2 class="font-size-regular"><a href="#">{{ $actualite->title }}</a></h2>
              <div class="meta mb-4">Ambaza Marcellin <span class="mx-2">&bullet;</span> Le {{ \Carbon\Carbon::parse($actualite->created_at)->format('d/m/Y h:i:s') }}<span class="mx-2">&bullet;</span></div>
              <p>
                {{ substr(strip_tags($actualite->description), 0, 100) }}
              </p>
              @if( strlen(strip_tags($actualite->description)) > 100 )
              <p>
                <a href="{{ route('site.actualite-show',$actualite->id)}}">lire plus...</a>
              </p>
              @endif
            </div> 
          </div>
          @endforeach
        </div>   
          {{$actualites->links()}}   
    </section>

  </div>
    @include('frontend.footer')

  @include('frontend.scripts')

  
  </body>
</html>