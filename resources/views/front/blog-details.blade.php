@extends("front.layouts.app")

@section("content")
    <!-- Page Content -->
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{$blog->title}}</h1>
                    <span><i class="fa fa-user"></i>    <a class="text-light" href="{{route('profile', $blog->getUsers)}}">{{$blog->getUsers->name}} {{$blog->getUsers->surname}}</a>  &nbsp;|&nbsp; <i class="fa fa-calendar"></i> {{$blog->updated_at->diffForHumans()}}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="more-info about-info">
        <div class="container">
            @if(session("success"))
                <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
                    {{session("success")}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="more-info-content">
                <div class="right-content">
                    <div>
                        @if($blog->media)
                            <img src="{{asset("assets/images/$blog->media")}}" class="img-fluid w-100" style="height: 350px; object-fit: contain">
                        @endif
                    </div>
                    <h2 class="text-center mt-5">{{$blog->title}}</h2>
                    <p class="mt-5">{{$blog->content}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="callback-form contact-us">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Yorum <em>yap</em></h2>
                        <span>Fikirlerinizi Paylaşın, Duyurun!</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="contact-form" data-blog-id="{{$blog->id}}">
                        <form id="commentForm">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="name_surname" type="text" class="form-control" id="name_surname" placeholder="Ad Soyad" autocomplete="off">
                                    </fieldset>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="email" type="text" class="form-control" id="email" pattern="[^ @]*@[^ @]*" placeholder="E-Posta" autocomplete="off">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <textarea name="comment" rows="6" class="form-control" id="comment" placeholder="Yorumunuz" autocomplete="off"></textarea>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="sendCommentButton" class="filled-button">Gönder</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let blogID = document.querySelector('.contact-form').getAttribute('data-blog-id');

            document.getElementById("sendCommentButton").addEventListener("click", function(e) {
                e.preventDefault()
                if (blogID) {
                    fetch("{{ route('sendComment') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            blog_id: blogID,
                            name_surname: document.getElementById('name_surname').value,
                            email: document.getElementById('email').value,
                            comment: document.getElementById('comment').value
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
