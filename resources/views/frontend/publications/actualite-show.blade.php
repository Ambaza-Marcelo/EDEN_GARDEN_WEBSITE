<!doctype html>
<html lang="en">
  <head>
    <title>Actualité </title>
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
    
    <div class="site-blocks-cover overlay" style="background-image: url({{ asset('storage/actualites')}}/{{$actualite->image}});" data-aos="fade">
      <div class="container">
        <div class="row align-items-center justify-content-center">
    
    
          <div class="col-md-12 mt-lg-5 text-center">
            <h1>{{$actualite->title}}</h1>
            <p class="post-meta">Le {{ \Carbon\Carbon::parse($actualite->created_at)->format('d/m/Y h:i:s') }}
            </p>
    
          </div>
    
        </div>
      </div>
    </div>
    
    
    
    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 blog-content">
            <div class="row mb-5">
              <div class="col-lg-6">
                <figure><img src="{{ asset('storage/actualites')}}/{{$actualite->image}}" alt="Image" class="img-fluid">
                  <figcaption>{{ $actualite->title }}</figcaption>
                  <figcaption>Le {{ \Carbon\Carbon::parse($actualite->created_at)->format('d/m/Y h:i:s') }}</figcaption>
                </figure>
              </div>
            </div>
            <p class="lead">{{ $actualite->description }}</p>
    
            <div class="pt-5">
              <p>Categories: <a href="#">Economie</a>
            </div>
    
    
            <div class="pt-5">
              <h3 class="mb-5">{{$total_comments}} Commentaire @if($total_comments > 1)s @endif</h3>
              <ul class="comment-list">
                @foreach($comments as $comment)
                <li class="comment">
                  <div class="vcard bio">
                    <img src="{{ asset('frontend/images/undraw_pic_profil.svg')}}" alt="Image">
                  </div>
                  <div class="comment-body">
                    <h3>{{$comment->name}}</h3>
                    <div class="meta">Le {{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y h:i:s') }}</div>
                    <p>{{$comment->message}}</p>
                  </div>
                </li>
                @endforeach
              </ul>
    
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Laisser un commentaire</h3>
                <form action="{{route('site.comments.store')}}" class="p-5 bg-light" method="post">
                  @csrf
                  <input type="hidden" name="actualite_id" value="{{ $actualite->id }}">
                  <div class="form-group">
                    <label for="name">Votre nom</label>
                    <input type="text" class="form-control" id="name" name="name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" class="form-control" id="email" name="email">
                  </div>
                  <div class="form-group">
                    <label for="website">Site web</label>
                    <input type="url" class="form-control" id="website" name="web_site">
                  </div>
    
                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Envoyer" class="btn btn-primary">
                  </div>
    
                </form>
              </div>
            </div>
    
          </div>
          <div class="col-md-4 sidebar">
            <div class="sidebar-box">
              <form action="#" class="search-form">
                <div class="form-group">
                  <span class="icon fa fa-search"></span>
                  <input type="text" class="form-control" placeholder="Taper mot clé">
                </div>
              </form>
            </div>
            <div class="sidebar-box">
              <div class="categories">
                <h3>Categories</h3>
                <li><a href="#">Sport <span>(12)</span></a></li>
                <li><a href="#">Politique <span>(22)</span></a></li>
                <li><a href="#">Actualités <span>(37)</span></a></li>
                <li><a href="#">Education <span>(42)</span></a></li>
                <li><a href="#">Economie<span>(14)</span></a></li>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    @include('frontend.footer')
  </div> 

  @include('frontend.scripts')

  
  </body>
</html>