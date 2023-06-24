@extends('frontend.layouts.app')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{ url('') }}">Home</a></li>
          <li><a href="">Blog</a></li>
          <li>{{$artikel->judul  }}</li>
        </ol>
        <h2>Blog</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">


            <article class="entry">

              <div class="entry-img">
                <img src="{{ url('storage/gambar/'.$artikel->gambar .'') }}" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="{{ route('artikel.read',$artikel->slug) }}">{{$artikel->judul  }}</a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="{{ route('artikel.read',$artikel->slug) }}">{{$artikel->users->name}}</a></li>                  
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($artikel->updated_at)->format('d M Y') }}</li>
                  {{-- <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="{{ route('artikel.read',$item->slug) }}">12 Comments</a></li> --}}
                </ul>
              </div>

              <div class="entry-content">
                {!! $artikel->isi !!}
              </div>

            </article><!-- End blog entry -->
            <div class="blog-comments">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                  <p>{{ $message }}</p>
                </div>
              @endif
                @if (Route::has('login'))
                
                    @auth
                    <div class="reply-form">
                        <h4>Komentar</h4>
                        <p>Isian </p>
                        <form action="{{ url('/submitkomentar') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-lg" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $artikel->id }}" class="form-control">
                        <input type="hidden" name="parent_id" id="parent_id" class="form-control" >
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" class="form-control" >
                          
                          <div class="row">
                            <div class="col form-group">
                              <input type="text" readonly class="form-control"  id="replyComment">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col form-group">
                              <textarea name="komentar" class="form-control" placeholder="komentar kamu*"></textarea>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary">Komentar</button>
        
                        </form>
        
                      </div>
                    @else
                    
                    @endauth
                
                @endif
                <br>
                <h4 class="comments-count">{{ $hitung_komentar }} Comments</h4>
                
                @foreach ($artikel->komentars as $row) 
                @php
                $iduser=$row->user_id;
                $nama_user= \App\Models\User::where('id',$iduser)->first();
                //  dd($nama_user);
                @endphp               
                <div id="comment-2" class="comment">
                  <div class="d-flex">
                    {{-- <div class="comment-img"><img src="assets/img/blog/comments-2.jpg" alt=""></div> --}}
                    <div>
                      <h5>{{ $nama_user->name }} <a href="javascript:void(0)" onclick="balasKomentar({{ $row->id }}, '{{ $row->komentar }}')" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                      <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($row->updated_at)->format('d M Y') }}</time>
                      <p>
                        {{ $row->komentar }}
                      </p>
                    </div>
                  </div>
                  @foreach ($row->child as $val)
                    @php
                    $iduser2=$val->user_id;
                    $nama_user2= \App\Models\User::where('id',$iduser2)->first();
                    //  dd($nama_user);
                    @endphp 
                  <div id="comment-reply-1" class="comment comment-reply">
                    <div class="d-flex">
                      {{-- <div class="comment-img"><img src="assets/img/blog/comments-3.jpg" alt=""></div> --}}
                      <div>
                        <h5>{{ $nama_user2->name }} </h5>
                        <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($val->updated_at)->format('d M Y') }}</time>
                        <p>
                            {{ $val->komentar }}
                        </p>
                      </div>
                    </div>
  
                  </div><!-- End comment reply #1-->
                  @endforeach
                </div><!-- End comment #2-->
                @endforeach
                
                
  
              </div><!-- End blog comments -->

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
  <script>
    function balasKomentar(id, title) {
        $('#formReplyComment').show();
        $('#parent_id').val(id)
        $('#replyComment').val(title)
    }
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.your-class').slick({
        setting-name: setting-value
      });
    });
  </script>
  
@endsection
