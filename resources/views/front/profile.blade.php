@extends("front.layouts.app")
@section("content")

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{$user->name}} {{$user->surname}}</h1>
                    <span>Profilime Hoşgeldin!</span>
                </div>
            </div>
        </div>
    </div>

    <div class="team" style="margin: 0">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="team-item">
                        @if($user->profile_photo_path == null)
                            <img src="{{asset("assets/images/anonymous.png")}}">
                        @else
                            <img src="{{ asset('assets/images/'.$user->profile_photo_path) }}">
                        @endif
                        <div class="down-content">
                            <h4>{{$user->name." ".$user->surname}}</h4>
                            <span>{{$user->job}}</span>
                            @if($user->bio == null)
                                <p>Merhaba, ben {{$user->name}}!</p>
                            @else
                                <p>{{$user->bio}}</p>
                            @endif
                            <h4 class="mt-5">Telefon</h4>
                            <strong><a href="tel:{{$user->phone}}">{{$user->phone}}</a></strong>
                            <h4 class="mt-3">Email</h4>
                            <strong><a href="mailto:{{$user->email}}">{{$user->email}}</a></strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 px-5">
                    <h2>Arabalar</h2>
                    <div class="row mt-5">
                        @if($cars->count() > 0)
                            <div class="col-md-12 owl-testimonials owl-carousel">
                                @foreach($cars as $car)
                                    <div class="service-item">
                                        @if($car->media == null)
                                            <img src="{{ asset('assets/images/no-car.jpg') }}" alt="">
                                        @else
                                            <img src="{{ asset('assets/images/'.$car->media) }}" alt="">
                                        @endif
                                        <p class="mt-2">{{$car->title}}</p>
                                        <div>
                                            <span>
                                                <sup>₺</sup>{{$car->price}}
                                            </span>
                                        </div>
                                        <p>
                                            <i class="fa fa-dashboard"></i> {{$car->km}}km &nbsp;&nbsp;&nbsp;
                                            <i class="fa fa-cog"></i> {{$gearTypes[$car->gear_type]}} &nbsp;&nbsp;&nbsp;
                                        </p>
                                        <a href="{{route("car-details", $car)}}" class="filled-button mt-3">İncele</a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <h2 class="text-center" style="opacity: 25%">Henüz bir araba mevcut değil.</h2>
                        @endif
                    </div>

                    <h2 class="mt-5">Blogların</h2>
                    <div class="row mt-5">
                        @if($blogs->count() > 0)
                            <div class="col-md-12 owl-testimonials owl-carousel">
                                @foreach($blogs as $blog)
                                    <section >
                                        <article id="tabs-1">
                                            @if($blog->media == null)
                                                <img src="{{ asset('assets/images/no-car.jpg') }}" alt="">
                                            @else
                                                <img src="{{ asset('assets/images/'.$blog->media) }}" alt="">
                                            @endif
                                            <h4 class="my-3"><a href="{{"blog-details", $blog->id}}" class="text-dark">{{$blog->title}}</a></h4>
                                            <div style="margin-bottom:10px;" class="mt-2">
                                                <span>{{$blog->getUsers->name}} {{$blog->getUsers->surname}} | {{$blog->updated_at->diffForHumans()}}</span>
                                            </div>
                                            <p>{{Str::limit($blog->content, 85)}}</p>
                                            <br>
                                            <div>
                                                <a href="{{route("blog-details", $blog)}}" class="filled-button">Oku</a>
                                            </div>
                                        </article>
                                    </section>
                                @endforeach
                            </div>
                        @else
                            <h2 class="text-center" style="opacity: 25%">Henüz bir blog mevcut değil.</h2>
                        @endif
                    </div>

                    <h2 class="mt-5">Yorumları</h2>
                    <div class="row mt-4">
                        @if(isset($carComments) && $carComments->count() > 0)
                            <div class="col-md-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-3">
                                        @foreach($carComments as $comment)
                                            @php
                                                $initial = strtoupper(substr($user->name, 0, 1));
                                            @endphp
                                            <div class="d-flex gap-3 align-items-start pb-3 mb-3 border-bottom" @if($loop->last) style="border-bottom: none; padding-bottom: 0; margin-bottom: 0;" @endif>
                                                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-weight: 700;">
                                                    {{ $initial }}
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex flex-wrap align-items-center gap-2">
                                                        <strong>{{ $comment->car->title ?? 'Araç' }}</strong>
                                                        <span class="badge bg-light text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <div class="mt-2">{{ $comment->comment }}</div>
                                                    @if(isset($comment->car))
                                                        <a class="small" href="{{ route('car-details', ['id' => $comment->car->id]) }}">Aracı gör</a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-md-12">
                                <p class="text-muted">Henüz yorum yapmamış.</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
