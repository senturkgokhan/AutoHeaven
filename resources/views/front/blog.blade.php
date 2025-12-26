@extends("front.layouts.app")

@section("content")
    <!-- Page Content -->
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Bloglarımızı okuyun</h1>
                    <span>Keşfet, Oku, Keyif Al!</span>
                </div>
            </div>
        </div>
    </div>

    <div class="single-services">
        <div class="container">
            <div class="row">
                <div class="col-md-8 px-3">
                    <section class='tabs-content'>
                        @foreach($blogs as $blog)
                            <article id='tabs-1' class="mb-5">
                                @if($blog->media == null)
                                    <img src="{{asset("assets/images/no-car.jpg")}}" class="w-100" style="height: 350px; object-fit: contain">
                                @else
                                    <img src="{{asset("assets/images/$blog->media")}}" class="w-100" style="height: 350px; object-fit: contain">
                                @endif
                                <h4><a href="{{route("blog-details", $blog)}}">{{$blog->title}}</a></h4>
                                <div style="margin-bottom:10px;">
                                    <span><a class="text-dark" href="{{route('profile', $blog->getUsers)}}">{{$blog->getUsers->name}} {{$blog->getUsers->surname}}</a> &nbsp;|&nbsp; {{$blog->updated_at->diffForHumans()}}</span>
                                </div>
                                <p>{{Str::limit($blog->content, 200)}}</p>
                                <br>
                                <div>
                                    <a href="{{route("blog-details", $blog)}}" class="filled-button">Okumaya Devam Et</a>
                                </div>
                            </article>
                        @endforeach
                    </section>
                    <nav id="pagination-nav" class="my-5">
                        <ul id="pagination" class="pagination pagination-lg justify-content-center">
                            <li class="page-item {{ $blogs->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{$blogs->previousPageUrl()}}" aria-label="Previous">
                                    <span aria-hidden="true">«</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            @for($i = 1; $i <= $blogs->lastPage(); $i++)
                                <li class="page-item {{ $i == $blogs->currentPage() ? 'disabled' : '' }}"><a class="page-link" href="{{$blogs->url($i)}}">{{$i}}</a></li>
                            @endfor
                            <li class="page-item {{ !$blogs->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{$blogs->nextPageUrl()}}" aria-label="Next">
                                    <span aria-hidden="true">»</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="col-md-4">
                    <h4 class="h4">Yakın zamanda gönderilenler</h4>

                    <ul>
                        @foreach($blogs as $blog)
                            <li>
                                <h5 style="margin-bottom:10px;"><a href="{{route("blog-details", $blog)}}">{{$blog->title}}</a></h5>
                                <small><i class="fa fa-user"></i> <a class="text-dark" href="{{route('profile', $blog->getUsers)}}">{{$blog->getUsers->name}} {{$blog->getUsers->surname}}</a> &nbsp;|&nbsp; <i class="fa fa-calendar"></i> {{$blog->updated_at->diffForHumans()}}</small>
                            </li>

                            <li><br></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
@endsection
