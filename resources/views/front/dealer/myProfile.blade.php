@extends("front.layouts.app")

@section("content")

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Profil</h1>
                    <span>Hoşgeldin {{\Illuminate\Support\Facades\Auth::user()->name}}!</span>
                </div>
            </div>
        </div>
    </div>

    <div class="team" style="margin: 0">
        <div class="container">
            @if(session("success"))
                <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
                    {{session("success")}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
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
                            <div class="text-center">
                                <a href="{{route("sellCar")}}" class="filled-button mt-5">Araba Sat</a>
                                <a href="{{route("writeBlog")}}" class="filled-button mt-5">Blog Yaz</a>
                                <a href="{{route("editMyProfile")}}" class="filled-button mt-2">Profili Düzenle</a>
                                @if(\Illuminate\Support\Facades\Auth::user()->role == 0)
                                    <a href="{{route("admin")}}" class="filled-button mt-2">Yönetim</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 px-5">
                    <h2>Arabaların</h2>
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
                                            <i class="fa fa-dashboard"></i> {{$car->km}}km
                                            <i class="fa fa-cog"></i> {{$gearTypes[$car->gear_type]}}
                                        </p>
                                        <a href="{{route("car-details", $car)}}" class="filled-button mt-3">İncele</a>
                                        <a href="{{route("editCar", $car)}}" class="filled-button mt-3">Düzenle</a>
                                        <button type="button" class="filled-button border-0" data-bs-toggle="modal" data-bs-target="#exampleModal" data-car-id="{{$car->id}}">Sil</button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <h2 class="text-center" style="opacity: 25%">Henüz bir araba mevcut değil.</h2>
                        @endif
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form id="deleteCarForm" method="post" action="{{ route('deleteCar') }}">
                                    @csrf
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Uyarı!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Arabanızı ilandan kaldırmak mı istiyorsunuz?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                                        <button id="deleteCarButton" type="submit" class="btn btn-danger">Kaldır</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
                                            <h4 class="my-3"><a href="{{route("blog-details", $blog)}}" class="text-dark">{{$blog->title}}</a></h4>
                                            <div style="margin-bottom:10px;" class="mt-2">
                                                <span>{{$blog->getUsers->name}} {{$blog->getUsers->surname}} | {{$blog->updated_at->diffForHumans()}}</span>
                                            </div>
                                            <p>{{Str::limit($blog->content, 85)}}</p>
                                            <br>
                                            <div>
                                                <a href="{{route("blog-details", $blog)}}" class="filled-button">Oku</a>
                                                <a href="{{route("editBlog", $blog)}}" class="filled-button">Düzenle</a>
                                                <button type="button" class="filled-button border-0" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-blog-id="{{$blog->id}}">Sil</button>
                                            </div>
                                        </article>
                                    </section>
                                @endforeach
                            </div>
                        @else
                            <h2 class="text-center" style="opacity: 25%">Henüz bir blog mevcut değil.</h2>
                        @endif
                    </div>

                    <h2 class="mt-5">Yorumların</h2>
                    <div class="row mt-4">
                        @if(isset($carComments) && $carComments->count() > 0)
                            <div class="col-md-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-3">
                                        @foreach($carComments as $comment)
                                            <div class="d-flex gap-3 align-items-start pb-3 mb-3 border-bottom" @if($loop->last) style="border-bottom: none; padding-bottom: 0; margin-bottom: 0;" @endif>
                                                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-weight: 700;">
                                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
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
                                <p class="text-muted">Henüz bir yorum yok.</p>
                            </div>
                        @endif
                    </div>

                    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form id="deleteBlogForm" method="post" action="{{ route('deleteBlog') }}">
                                    @csrf
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel2">Uyarı!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Blogunuzu yayından kaldırmak mı istiyorsunuz?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                                        <button id="deleteBlogButton" type="submit" class="btn btn-danger">Kaldır</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let carID;

            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    carID = this.getAttribute('data-car-id');
                });
            });

            document.getElementById("deleteCarButton").addEventListener("click", function() {
                if (carID) {
                    fetch("{{ route('deleteCar') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            car_id: carID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert("Bir hata oluştu, lütfen tekrar deneyin.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let blogID;

            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    blogID = this.getAttribute('data-blog-id');
                });
            });

            document.getElementById("deleteBlogButton").addEventListener("click", function() {
                if (blogID) {
                    fetch("{{ route('deleteBlog') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            blog_id: blogID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert("Bir hata oluştu, lütfen tekrar deneyin.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
                }
            });
        });
    </script>
@endsection
