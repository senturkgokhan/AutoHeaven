@extends("front.layouts.app")
@section("content")
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Blog Yaz</h1>
                    <span>Bilgini Paylaş</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-5" style="background-color: #f7f7f7">
        <div class="row pt-5">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Blogunu Hızlıca <em>Paylaş</em></h2>
                    <span>Herkes Öğrensin!</span>
                </div>
            </div>
        </div>

        <div class="container pt-3 pb-5">

            @if(session("success"))
                <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
                    {{session("success")}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{route("writeBlogPost")}}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <h4 class="px-3">Blog Başlığı</h4>
                    <input name="title" type="text" class="form-control border-0 mt-3 p-3 shadow-none"  style="border-radius: 25px" id="name" placeholder="Başlık giriniz" value="{{old("title")}}" autocomplete="off">
                    @error("title")
                    <p class="m-3 text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mt-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="px-3">Blog İçeriği</h4>
                            <textarea name="content" class="form-control border-0 mt-3 p-3 shadow-none" rows="5" style="border-radius: 25px" id="name" placeholder="İçerik giriniz" autocomplete="off">{{old("content")}}</textarea>
                            @error("content")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <span class="h4 px-3 ">Blog Görseli</span>
                            <div class="input-group">
                                <div class="input-group">
                                    <input name="media" type="file" class="input-group mt-3 shadow-none" id="media" value="{{old("media")}}">
                                    <label class="custom-file-label mt-3 border-0 rounded-0"  for="media" data-content="Dosya Seçildi"></label>
                                </div>
                            </div>
                            @error("media")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <img src="" id="media-preview" style="max-width: 100%; max-height: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn text-light mt-5 px-5 py-3" style="background-color: #a4c639; border-radius: 25px">Yayınla</button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Dosya girişi değişikliği dinleyicisi
            $('#media').change(function() {
                var input = this;
                var url = URL.createObjectURL(input.files[0]);
                $('#media-preview').attr('src', url); // Önizleme görselinin src özelliğini ayarla
            });
        });
    </script>

@endsection

