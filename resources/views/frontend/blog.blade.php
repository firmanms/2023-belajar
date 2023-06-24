@extends('frontend.layouts.app')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{ url('') }}">Home</a></li>
          <li><a href="">Blog</a></li>          
        </ol>
        <h2>Blog</h2>

      </div>
    </section><!-- End Breadcrumbs -->

   <!-- ======= Blog Section ======= -->
   <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      <div class="row">

        <div class="col-lg-8 entries">
          @foreach ($artikels as $item)
              <article class="entry">

                <div class="entry-img">
                  <img src="{{ url('storage/gambar/'.$item->gambar .'') }}" alt="" class="img-fluid">
                </div>

                <h2 class="entry-title">
                  <a href="{{ route('artikel.read',$item->slug) }}">{{$item->judul  }}</a>
                </h2>

                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="{{ route('artikel.read',$item->slug) }}">{{$item->users->name}}</a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('artikel.read',$item->slug) }}">{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</a></li>
                    {{-- <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="{{ route('artikel.read',$item->slug) }}">12 Comments</a></li> --}}
                  </ul>
                </div>

                <div class="entry-content">
                  {!! $item->isi !!}
                  <div class="read-more">
                    <a href="{{ route('artikel.read',$item->slug) }}">Selengkapnya</a>
                  </div>
                </div>

              </article><!-- End blog entry -->
          @endforeach
          

          

          <div class="blog-pagination">
            {{ $artikels->links() }}
          </div>

        </div><!-- End blog entries list -->

        <div class="col-lg-4">

          <div class="sidebar">

            <!--<h3 class="sidebar-title">Search</h3>
            <div class="sidebar-item search-form">
              <form action="">
                <input type="text">
                <button type="submit"><i class="bi bi-search"></i></button>
              </form>
            </div> End sidebar search formn-->

            <!--<h3 class="sidebar-title">Categories</h3>
            <div class="sidebar-item categories">
              <ul>
                <li><a href="#">General <span>(25)</span></a></li>
                <li><a href="#">Lifestyle <span>(12)</span></a></li>
                <li><a href="#">Travel <span>(5)</span></a></li>
                <li><a href="#">Design <span>(22)</span></a></li>
                <li><a href="#">Creative <span>(8)</span></a></li>
                <li><a href="#">Educaion <span>(14)</span></a></li>
              </ul>
            </div> End sidebar categories-->

            <h3 class="sidebar-title">Recent Posts</h3>
            <div class="sidebar-item recent-posts">
              @foreach ( $artikelrecents as $artikelrecent)
              <div class="post-item clearfix">
                <img src="{{ url('storage/gambar/'.$artikelrecent->gambar .'') }}" alt="">
                <h4><a href="{{ route('artikel.read',$artikelrecent->slug) }}">{{ $artikelrecent->judul }}</a></h4>
                <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($artikelrecent->publish)->format('d M Y') }}</time>
              </div>
              @endforeach

            </div><!-- End sidebar recent posts-->

            <!--<h3 class="sidebar-title">Tags</h3>
            <div class="sidebar-item tags">
              <ul>
                <li><a href="#">App</a></li>
                <li><a href="#">IT</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Mac</a></li>
                <li><a href="#">Design</a></li>
                <li><a href="#">Office</a></li>
                <li><a href="#">Creative</a></li>
                <li><a href="#">Studio</a></li>
                <li><a href="#">Smart</a></li>
                <li><a href="#">Tips</a></li>
                <li><a href="#">Marketing</a></li>
              </ul>
            </div> End sidebar tags-->

          </div><!-- End sidebar -->

        </div><!-- End blog sidebar -->

      </div>

    </div>
  </section><!-- End Blog Section -->

  </main><!-- End #main -->
  <script type="text/javascript">
    $(document).ready(function(){
      $('.your-class').slick({
        setting-name: setting-value
      });
    });
  </script>
@endsection
