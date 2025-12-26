@extends("front.layouts.app")

@section("content")

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Profilini Düzenle</h1>
                    <span>Kendini Tanıt!</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-5" style="background-color: #f7f7f7">
        <div class="row pt-5">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Kendi Profilini <em>Düzenle</em></h2>
                    <span>İstediğin Gibi Tanıt</span>
                </div>
            </div>
        </div>

        <div class="container pt-3 pb-5">

            <form action="{{route("editMyProfilePost")}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mt-5">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="px-3">Ad</h4>
                            <input name="name" type="text" class="form-control border-0 mt-3 p-3 shadow-none"  style="border-radius: 25px" id="name" placeholder="Ad giriniz" value="{{$user->name}}" autocomplete="off">
                            @error("name")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <span class="h4 px-3">Soyad</span>
                            <input name="surname" type="text" class="form-control border-0 mt-3 p-3 shadow-none"  style="border-radius: 25px" id="surname" placeholder="Soyad giriniz" value="{{$user->surname}}" autocomplete="off">
                            @error("surname")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="px-3">E-Posta</h4>
                            <input name="email" type="email" class="form-control border-0 mt-3 p-3 shadow-none"  style="border-radius: 25px" id="email" placeholder="E-Posta giriniz" value="{{$user->email}}" autocomplete="off">
                            @error("name")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <span class="h4 px-3">Parola</span>
                            <input name="password" type="password" class="form-control border-0 mt-3 p-3 shadow-none"  style="border-radius: 25px" id="phone" placeholder="Parola giriniz" autocomplete="off">
                            @error("password")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="h4 px-3">Telefon</span>
                            <input name="phone" type="tel" class="form-control border-0 mt-3 p-3 shadow-none"  style="border-radius: 25px" id="phone" placeholder="Telefon numarası giriniz" value="{{$user->phone}}" autocomplete="off">
                            @error("phone")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <span class="h4 px-3">İş</span>
                            <input name="job" type="text" class="form-control border-0 mt-3 p-3 shadow-none"  style="border-radius: 25px" id="job" placeholder="İş giriniz" value="{{$user->job}}" autocomplete="off">
                            @error("job")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="px-3">Biyografi</h4>
                            <textarea name="bio" class="form-control border-0 mt-3 p-3 shadow-none" rows="3" style="border-radius: 25px" id="bio" placeholder="Kendinizi tanıtın" autocomplete="off">{{$user->bio}}</textarea>
                            @error("bio")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <h4 class="px-3">Fotoğraf Yükle <span class="float-right"><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-trash"></i></button></span></h4>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Uyarı!</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Profil fotoğrafınızı kaldırmak mı istiyorsunuz?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                                            <button id="deleteMyProfilePhotoButton" type="submit" class="btn btn-danger">Kaldır</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="input-group">
                                    <input name="photo" type="file" class="input-group mt-3 shadow-none" id="photo">
                                    <label class="custom-file-label mt-3 border-0 rounded-0"  for="photo" data-content="Dosya Seçildi"></label>
                                </div>
                            </div>
                            @error("photo")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <img src="" id="photo-preview" style="max-width: 100%; max-height: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center pb-5">
                    <button type="submit" class="btn text-light mt-5 px-5 py-3" style="background-color: #a4c639; border-radius: 25px">Güncelle</button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#photo').change(function() {
                var input = this;
                var url = URL.createObjectURL(input.files[0]);
                $('#photo-preview').attr('src', url);
            });
        });
    </script>
    <script>
        document.getElementById("deleteMyProfilePhotoButton").addEventListener("click", function() {
            fetch("{{ route('deleteMyProfilePhoto') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    user_id: {{ $user->id }}
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = response.redirect;
                } else {
                    alert("Bir hata oluştu, lütfen tekrar deneyin.");
                }
            })
            .catch(error => console.error("Error:", error));
        });
    </script>

@endsection
