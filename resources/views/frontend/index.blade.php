@extends('frontend.layouts.app')

@section('content')

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">

  <div class="container">
    <div class="row">
      <div class="col-lg-6 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">We offer modern solutions for growing your business</h1>
        <h2 data-aos="fade-up" data-aos-delay="400">We are team of talented designers making websites with Bootstrap</h2>
        <div data-aos="fade-up" data-aos-delay="600">
          <div class="text-center text-lg-start">
            <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
              <span>Get Started</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
        <img src="assets/img/hero-img.png" class="img-fluid" alt="">
      </div>
    </div>
  </div>

</section><!-- End Hero -->

<!-- ======= Recent Blog Posts Section ======= -->
<section id="recent-blog-posts" class="recent-blog-posts">

    <div class="container" data-aos="fade-up">

      <header class="section-header">
        <h2>Blog</h2>
        <p>Blog Terbaru</p>
      </header>

      <div class="row">

        @foreach ($blog as $item)
        <div class="col-lg-4">
          <div class="post-box">
            <div class="post-img"><img src="{{ url('storage/gambar/'.$item->gambar .'') }}" class="img-fluid" alt=""></div>
            <span class="post-date">{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</span>
            <h3 class="post-title">{{ $item->judul }}</h3>
            <a href="{{ route('artikel.read',$item->slug) }}" class="readmore stretched-link mt-auto"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        @endforeach        

      </div>

    </div>

  </section><!-- End Recent Blog Posts Section -->
@endsection