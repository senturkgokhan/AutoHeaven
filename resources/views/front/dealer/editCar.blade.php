@extends("front.layouts.app")
@section("content")
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Arabanı Düzenle</h1>
                    <span>Arabanın Bilgilerini Değiştir</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-5" style="background-color: #f7f7f7">
        <div class="row pt-5">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Arabanı Hızlıca <em>Güncelle</em></h2>
                    <span>En Güncel Haliyle</span>
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

            <form action="{{route('editCarPost', $id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <h4 class="px-3">Araç Başlığı</h4>
                    <input name="title" type="text" class="form-control border-0 mt-3 p-3 shadow-none"  style="border-radius: 25px" id="name" placeholder="Başlık giriniz" value="{{$car->title}}" autocomplete="off">
                    @error("title")
                    <p class="m-3 text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mt-5">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="px-3">Araç Açıklaması</h4>
                            <textarea name="description" class="form-control border-0 mt-3 p-3 shadow-none" rows="3" style="border-radius: 25px" id="name" placeholder="Açıklama giriniz" autocomplete="off">{{$car->description}}</textarea>
                            @error("description")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <span class="h4 px-3">Araç Hasarı</span>
                            <textarea name="damage-description" class="form-control border-0 mt-3 p-3 shadow-none" rows="3" style="border-radius: 25px" id="damage-description" placeholder="Açıklama giriniz" autocomplete="off">{{$car->getDamages->description}}</textarea>
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
                                <!-- Mevcut marka seçili olacak -->
                                <option value="{{$car->getModels->getBrands->id}}" selected>{{$car->getModels->getBrands->name}}</option>
                                @foreach($carBrands as $item)
                                    @if($item->id == $car->getModels->getBrands->id)
                                        @continue($item)
                                    @endif
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error("brand")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <span class="h4 px-3">Araç Modeli</span>
                            <select id="model" name="model" class="form-control mt-3 border-0 shadow-none" data-selected-model="{{$car->getModels->id}}" style="border-radius: 25px">
                                <!-- Mevcut model seçili olacak -->
                                <option value="{{$car->getModels->id}}" selected>{{$car->getModels->name}}</option>
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
                            <input name="year" type="date" class="form-control border-0 mt-3 p-3 shadow-none"  style="border-radius: 25px" id="year" placeholder="Başlık giriniz" value="{{$car->year}}" autocomplete="off">
                            @error("year")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <span class="h4 px-3 ">Araç Rengi</span>
                            <select class="form-control mt-3 border-0 shadow-none" name="color" style="border-radius: 25px">
                                <option value="{{$car->color}}" selected>{{$selectBoxValues[0][$car->color]}}</option>
                                @for($i = 1; $i < 8; $i++)
                                    @if($i == $car->color)
                                        @continue($i)
                                    @endif
                                    <option value="{{$i}}">{{$selectBoxValues[0][$i]}}</option>
                                @endfor
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
                                <input name="km" type="text" class="form-control border-0 mt-3 p-3 shadow-none"  style="border-radius: 25px" id="km" placeholder="Kilometre giriniz" value="{{$car->km}}" autocomplete="off">
                                <span class="input-group-text border-0 mt-3" style="border-radius: 25px">KM</span>
                            </div>
                            @error("km")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <span class="h4 px-3 ">Araç Garantisi</span>
                            <select class="form-control mt-3 border-0 shadow-none" name="guarantee" style="border-radius: 25px">
                                <option value="{{$car->guarantee}}" selected>{{$selectBoxValues[1][$car->guarantee]}}</option>
                                @for($i = 1; $i < 3; $i++)
                                    @if($i == $car->guarantee)
                                        @continue($i)
                                    @endif
                                    <option value="{{$i}}">{{$selectBoxValues[1][$i]}}</option>
                                @endfor
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
                                <option value="{{$car->gear_type}}" selected>{{$selectBoxValues[2][$car->gear_type]}}</option>
                                @for($i = 1; $i < 4; $i++)
                                    @if($i == $car->gear_type)
                                        @continue($i)
                                    @endif
                                    <option value="{{$i}}">{{$selectBoxValues[2][$i]}}</option>
                                @endfor
                            </select>
                            @error("gear")
                            <p class="m-3 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <span class="h4 px-3 ">Araç Yakıt Türü</span>
                            <select class="form-control mt-3 border-0 shadow-none" name="fuel" style="border-radius: 25px">
                                <option value="{{$car->fuel_type}}" selected>{{$selectBoxValues[3][$car->fuel_type]}}</option>
                                @for($i = 1; $i < 5; $i++)
                                    @if($i == $car->fuel_type)
                                        @continue($i)
                                    @endif
                                    <option value="{{$i}}">{{$selectBoxValues[3][$i]}}</option>
                                @endfor
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
                                <input type="text" name="price" class="form-control mt-3 border-0 p-3 shadow-none" placeholder="Fiyat Giriniz" aria-label="Amount (to the nearest dollar)" style="border-radius: 25px" value="{{$car->price}}" autocomplete="off">
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
                    <button type="submit" class="btn text-light mt-5 px-5 py-3" style="background-color: #a4c639; border-radius: 25px">Güncelle</button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Mevcut marka ve model bilgilerini al
            var selectedBrandID = $('#brand').val();  // Mevcut seçili marka ID'si
            var selectedModelID = $('#model').data('selected-model');  // Mevcut seçili model ID'sini data attribute ile al

            // Marka değiştiğinde çalışacak fonksiyon
            function filterModels(brandID, selectedModelID = null) {
                if (brandID) {
                    // AJAX isteği gönder
                    $.ajax({
                        type: 'GET',
                        url: '/sellCarModelFilter/' + brandID, // Controller'a gönderilecek route
                        success: function(data) {
                            // Model selectbox'ını temizle ve yeni seçenekleri ekle
                            $('#model').empty();
                            $.each(data, function(index, model) {
                                var selected = model.id == selectedModelID ? 'selected' : ''; // Eğer mevcut model ID'si ile eşleşiyorsa seçili yap
                                $('#model').append('<option value="' + model.id + '" ' + selected + '>' + model.name + '</option>');
                            });
                        }
                    });
                }
            }

            // Sayfa yüklendiğinde mevcut markaya göre modeli filtrele
            if (selectedBrandID) {
                filterModels(selectedBrandID, selectedModelID);
            }

            // Marka değiştiğinde yeni modelleri filtrele
            $('#brand').change(function() {
                var brandID = $(this).val(); // Seçilen marka ID'si
                filterModels(brandID);
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
