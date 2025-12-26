@extends("front.layouts.app")

@section("content")

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Gelen Kutusu</h1>
                    <span>Hoşgeldin {{\Illuminate\Support\Facades\Auth::user()->name}}!</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-5" style="background-color: #f7f7f7">
        <div class="row pt-5">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Gelen Kutusunu <em>İncele</em></h2>
                    <span>Son Yorumlara Göz At</span>
                </div>
            </div>
        </div>

        <div class="container pt-3 pb-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    @if($groupedComments->count() > 0)
                        @foreach($groupedComments as $blog_id => $blogComments)
                            <h3 class="{{ $loop->first ? '' : 'mt-5' }}"><a href="{{route("blog-details", $blogComments->first()->getBlogs)}}" class="text-dark" target="_blank">{{$blogComments->first()->getBlogs->title}}</a> Yorumları</h3>

                            @foreach($blogComments as $comment)
                                <div class="card mt-3 border-0">
                                    <div class="card-body">
                                        <div class="d-flex flex-start align-items-center">
                                            <img class="rounded-circle shadow-1-strong me-3" src="{{ $comment->user_photo }}" alt="avatar" width="60" height="60" />
                                            <div>
                                                <h6 class="fw-bold text-primary mb-1">
                                                    @if($comment->user_id)
                                                        <a href="{{ route('profile', $comment->user_id) }}" target="_blank">{{ $comment->name_surname }}</a>
                                                    @else
                                                        {{ $comment->name_surname }}
                                                    @endif
                                                </h6>
                                                <p class="text-muted small mb-0">
                                                    {{ $comment->email }} - {{ $comment->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>

                                        <p class="mt-3 mb-4 pb-2">
                                            {{ $comment->comment }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @else
                        <h2 class="text-center mb-5" style="opacity: 25%">Henüz bir mesaj mevcut değil.</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
