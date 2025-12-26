@extends("front.layouts.app")

@section("content")
    <!-- Page Content -->
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><sup>₺</sup>{{$car->price}}</h1>
                    <span>
                En Uygun Fiyatlar Burada!
            </span>
                </div>
            </div>
        </div>
    </div>

    <div class="services">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    @if($car->media == null)
                        <img src="{{ asset('assets/images/no-car.jpg') }}" alt="" class="img-fluid wc-image w-100" style="height: 350px; object-fit: contain;">
                    @else
                        <img src="{{ asset('assets/images/'.$car->media) }}" alt="" class="img-fluid wc-image w-100" style="height: 350px; object-fit: contain;">
                    @endif
                </div>

                <div class="col-md-5">
                    <form action="#" method="post" class="form">
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Marka</span>

                                    <strong class="pull-right">{{$car->getModels->getBrands->name}}</strong>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Model</span>

                                    <strong class="pull-right">{{$car->getModels->name}}</strong>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Yıl</span>

                                    <strong class="pull-right">{{$car->year}}</strong>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Renk</span>

                                    <strong class="pull-right">{{$selectBoxValues[0]}}</strong>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Kilometre</span>

                                    <strong class="pull-right">{{$car->km}}</strong>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Garanti</span>

                                    <strong class="pull-right">{{$selectBoxValues[1]}}</strong>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Vites Türü</span>

                                    <strong class="pull-right">{{$selectBoxValues[2]}}</strong>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Yakıt Türü</span>

                                    <strong class="pull-right">{{$selectBoxValues[3]}}</strong>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Fiyat</span>

                                    <strong class="pull-right">{{$car->price}}₺</strong>
                                </div>
                            </li>

                        </ul>
                    </form>

                    <br>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <div class="tabs-content">
                            <div class="row">
                                <div class="col-12">
                                    <h2>{{$car->title}}</h2>
                                    <p>{{$car->description}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="tabs-content mt-3">
                            <div class="row">
                                <div class="col-12">
                                    <h4>Hasar Açıklaması</h4>
                                    @if($car->getDamages->description == null)
                                        <p>Hasar açıklaması mevcut değil.</p>
                                    @else
                                        <p>{{$car->getDamages->description}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 text-lg-center">

                    <div class="tabs-content">
                        <h4 class="mt-0">İletişim Detayları</h4>

                        <p>
                            <span>Ad</span>

                            <br>

                            <strong>
                                <a href="{{ route('profile', ['id' => $user->id]) }}">{{ $user->name }} {{ $user->surname }}</a>
                            </strong>
                        </p>

                        <p>
                            <span>Telefon</span>

                            <br>

                            <strong>
                                <a href="tel:{{$user->phone}}">{{$user->phone}}</a>
                            </strong>
                        </p>

                        <p>
                            <span>Email</span>

                            <br>

                            <strong>
                                <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                            </strong>
                        </p>
                    </div>

                    <br>
                </div>
            </div>

            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-md-7">
                    <h4>Yorumlar</h4>

                    @if($car->comments->isEmpty())
                        <p>Henüz yorum yok.</p>
                    @else
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-3">
                                @foreach($car->comments as $comment)
                                    @php
                                        $author = $comment->user ? $comment->user->name : 'Kullanıcı';
                                        $initial = strtoupper(substr($author, 0, 1));
                                    @endphp
                                    <div class="d-flex gap-3 align-items-start pb-3 mb-3 border-bottom" @if($loop->last) style="border-bottom: none; padding-bottom: 0; margin-bottom: 0;" @endif>
                                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-weight: 700;">
                                            {{ $initial }}
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex flex-wrap align-items-center gap-2">
                                                <strong>
                                                    @if($comment->user)
                                                        <a href="{{ route('profile', ['id' => $comment->user->id]) }}" class="text-dark">{{ $author }}</a>
                                                    @else
                                                        {{ $author }}
                                                    @endif
                                                </strong>
                                                <span class="badge bg-light text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="mt-2">{{ $comment->comment }}</div>

                                            @auth
                                                @if(Auth::id() === $comment->user_id || Auth::user()->role === 0)
                                                    <div class="mt-2 d-flex gap-2 flex-wrap">
                                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="toggleEditForm({{ $comment->id }})">Düzenle</button>
                                                        <form action="{{ route('car-details.comment.delete', ['car' => $car->id, 'comment' => $comment->id]) }}" method="POST" onsubmit="return confirm('Yorumu silmek istediğinize emin misiniz?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">Sil</button>
                                                        </form>
                                                    </div>
                                                    <form id="edit-form-{{ $comment->id }}" class="mt-2 d-none" action="{{ route('car-details.comment.update', ['car' => $car->id, 'comment' => $comment->id]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <textarea name="comment" rows="3" class="form-control" required minlength="3" maxlength="2000">{{ $comment->comment }}</textarea>
                                                        </div>
                                                        <div class="d-flex gap-2 mt-2">
                                                            <button type="submit" class="btn btn-sm btn-success">Kaydet</button>
                                                            <button type="button" class="btn btn-sm btn-secondary" onclick="toggleEditForm({{ $comment->id }})">Vazgeç</button>
                                                        </div>
                                                    </form>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @auth
                        <form action="{{ route('car-details.comment', ['id' => $car->id]) }}" method="POST" class="mt-3">
                            @csrf
                            <div class="form-group">
                                <label for="comment">Yorumunuz</label>
                                <textarea name="comment" id="comment" rows="4" class="form-control" required minlength="3" maxlength="2000"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success mt-2">Yorumu Gönder</button>
                        </form>
                    @else
                        <p>Yorum yapabilmek için lütfen <a href="{{ route('login') }}">giriş yapın</a>.</p>
                    @endauth
                </div>
            </div>
            <br>
        </div>
    </div>
    <script>
        function toggleEditForm(id) {
            const form = document.getElementById('edit-form-' + id);
            if (form) {
                form.classList.toggle('d-none');
            }
        }
    </script>
@endsection
