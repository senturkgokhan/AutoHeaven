@extends("front.layouts.app")

@section("content")
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Araba Sat</h1>
                    <span>Uygun Fiyatlı Araçlar</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-5" style="background-color: #f7f7f7">
        <div class="row pt-5">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Arabanı Hızlıca <em>Sat</em></h2>
                    <span>Araç Alım Satımı</span>
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

            <form action="{{route("sellCarPost")}}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <h4 class="px-3">Araç Başlığı</h4>
                    <input name="title" type="text" class="form-control border-0 mt-3 p-3 shadow-none"  style="border-radius: 25px" id="name" placeholder="Başlık giriniz" value="{{old("title")}}" autocomplete="off">
                    @error("title")
                    <p class="m-3 text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mt-5">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="px-3">Araç Açıklaması</h4>
                            <textarea name="description" class="form-control border-0 mt-3 p-3 shadow-none" rows="3" style="border-radius: 25px" id="name" placeholder="Açıklama giriniz" autocomplete="off">{{old("description")}}</textarea>
                            @error("description")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <span class="h4 px-3">Araç Hasarı</span>
                            <textarea name="damage-description" class="form-control border-0 mt-3 p-3 shadow-none" rows="3" style="border-radius: 25px" id="damage-description" placeholder="Açıklama giriniz" autocomplete="off">{{old("damage-description")}}</textarea>
                            @error("damage-description")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="h4 px-3">Araç Markası</span>
                            <select id="brand" name="brand" class="form-control mt-3 border-0 shadow-none" style="border-radius: 25px">
                                <option value="0" selected disabled>Lütfen Marka Seçiniz</option>
                                @foreach($carBrands as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error("brand")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <span class="h4 px-3 ">Araç Modeli</span>
                            <select id="model" name="model" class="form-control mt-3 border-0 shadow-none" style="border-radius: 25px">
                                <option value="0" selected disabled>Lütfen Model Seçiniz</option>
                                @foreach($carModels as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error("model")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="h4 px-3">Araç Yılı</span>
                            <input name="year" type="date" class="form-control border-0 mt-3 p-3 shadow-none"  style="border-radius: 25px" id="year" placeholder="Başlık giriniz" value="{{old("year")}}" autocomplete="off">
                            @error("year")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <span class="h4 px-3 ">Araç Rengi</span>
                            <select class="form-control mt-3 border-0 shadow-none" name="color" style="border-radius: 25px">
                                <option value="0" selected disabled>Lütfen Renk Seçiniz</option>
                                <option value="1">Beyaz</option>
                                <option value="2">Siyah</option>
                                <option value="3">Gri</option>
                                <option value="4">Gümüş</option>
                                <option value="5">Mavi</option>
                                <option value="6">Kırmızı</option>
                                <option value="7">Diğer</option>
                            </select>
                            @error("color")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="h4 px-3">Araç Kilometresi</span>
                            <div class="input-group">
                                <input name="km" type="text" class="form-control border-0 mt-3 p-3 shadow-none"  style="border-radius: 25px" id="km" placeholder="Kilometre giriniz" value="{{old("km")}}" autocomplete="off">
                                <span class="input-group-text border-0 mt-3" style="border-radius: 25px">KM</span>
                            </div>
                            @error("km")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <span class="h4 px-3">Araç Garantisi</span>
                            <select class="form-control mt-3 border-0 shadow-none" name="guarantee" style="border-radius: 25px">
                                <option value="0" selected disabled>Lütfen Garanti Seçiniz</option>
                                <option value="1">Var</option>
                                <option value="2">Yok</option>
                            </select>
                            @error("guarantee")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="h4 px-3">Araç Vites Türü</span>
                            <select class="form-control mt-3 border-0 shadow-none" name="gear" style="border-radius: 25px">
                                <option value="0" selected disabled>Lütfen Vites Türü Seçiniz</option>
                                <option value="1">Manuel</option>
                                <option value="2">Otomatik</option>
                                <option value="2">Yarı-Otomatik</option>
                            </select>
                            @error("gear")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <span class="h4 px-3 ">Araç Yakıt Türü</span>
                            <select class="form-control mt-3 border-0 shadow-none" name="fuel" style="border-radius: 25px">
                                <option value="0" selected disabled>Lütfen Yakıt Türü Seçiniz</option>
                                <option value="1">Benzin</option>
                                <option value="2">Dizel</option>
                                <option value="2">LPG</option>
                                <option value="2">Elektrik</option>
                            </select>
                            @error("fuel")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="h4 px-3 ">Araç Görseli</span>
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
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <span class="h4 px-3">Araç Fiyatı</span>
                            <div class="input-group mb-3">
                                <input type="text" name="price" class="form-control mt-3 border-0 p-3 shadow-none" placeholder="Fiyat Giriniz" aria-label="Amount (to the nearest dollar)" style="border-radius: 25px" value="{{old("price")}}" autocomplete="off">
                                <span class="input-group-text border-0 mt-3" style="border-radius: 25px">₺</span>
                            </div>
                            @error("price")
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
            // Marka seçildiğinde
            $('#brand').change(function() {
                var brandID = $(this).val(); // Seçilen marka ID'si

                // AJAX isteği gönder
                $.ajax({
                    type: 'GET',
                    url: '/sellCarModelFilter/' + brandID, // Controller'a gönderilecek route
                    success: function(data) {
                        // Başarılı dönen verileri model selectbox'ına ekle
                        $('#model').empty(); // Önceki seçenekleri temizle
                        $('#model').append('<option value="0">Lütfen Model Seçiniz</option>');
                        $.each(data, function(index, model) {
                            $('#model').append('<option value="' + model.id + '">' + model.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
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
