@extends("front.layouts.app")

<style>
    .table td, .table th {
        white-space: nowrap;
    }

    .nav-pills .nav-link:hover{
        background-color: rgba(0, 0, 0, .075);
    }

    .modal-body {
        max-height: 500px; /* İstediğiniz maksimum yüksekliği ayarlayın */
        overflow-y: auto; /* Dikey kaydırma çubuğunu ekle */
    }
</style>

@section("content")

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Yönetim</h1>
                    <span>Hoşgeldin {{\Illuminate\Support\Facades\Auth::user()->name}}!</span>
                </div>
            </div>
        </div>
    </div>

    <div class="team py-5" style="margin: 0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2">
                    <div class="d-flex flex-column flex-shrink-0 p-3" style="width: 280px;">
                        <a href="{{route("index")}}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                            <span class="fs-4">AutoHeaven</span>
                        </a>
                        <hr>
                        <ul class="nav nav-pills flex-column mb-auto">
                            <li class="nav-item">
                                <a href="{{route("admin")}}" class="nav-link link-dark" aria-current="page" >
                                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                                    Kullanıcılar
                                </a>
                            </li>
                            <li>
                                <a href="{{route("admin.cars")}}" class="nav-link active" style="background-color: #a4c639">
                                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                                    Arabalar
                                </a>
                            </li>
                            <li>
                                <a href="{{route("brandModel")}}" class="nav-link link-dark">
                                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                                    Araba Marka/Modelleri
                                </a>
                            </li>
                            <li>
                                <a href="{{route("carDamages")}}" class="nav-link link-dark">
                                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                                    Araba Hasarları
                                </a>
                            </li>
                            <li>
                                <a href="{{route("blogs")}}" class="nav-link link-dark">
                                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                                    Bloglar
                                </a>
                            </li>
                            <li>
                                <a href="{{route("admin.contact")}}" class="nav-link link-dark">
                                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                                    Destek
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 px-5">
                    <h2 class="px-3 pt-3">Arabalar Tablosu</h2>
                    <div class="table-responsive px-3">
                        <table class="table table-hover mt-5" style="--bs-table-bg: transparent;">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Sahip</th>
                                <th scope="col">Başlık</th>
                                <th scope="col">Açıklama</th>
                                <th scope="col">Marka</th>
                                <th scope="col">Model</th>
                                <th scope="col">Yıl</th>
                                <th scope="col">Renk</th>
                                <th scope="col">KM</th>
                                <th scope="col">Garanti</th>
                                <th scope="col">Vites Türü</th>
                                <th scope="col">Yakıt Türü</th>
                                <th scope="col">Hasar Açıklaması</th>
                                <th scope="col">Fiyat</th>
                                <th scope="col">İlan Durumu</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cars as $car)
                                <tr>
                                    <th scope="row">{{$car->id}}</th>
                                    <td>{{$car->getUsers->name}} {{$car->getUsers->surname}}</td>
                                    <td>{{Str::limit($car->title, 20)}}</td>
                                    <td>{{Str::limit($car->description, 25)}}</td>
                                    <td>{{$car->getModels->getBrands->name}}</td>
                                    <td>{{$car->getModels->name}}</td>
                                    <td>{{$car->year}}</td>
                                    <td>{{$selectBoxValues[0][$car->color]}}</td>
                                    <td>{{$car->km}}</td>
                                    <td>{{$selectBoxValues[1][$car->guarantee]}}</td>
                                    <td>{{$selectBoxValues[2][$car->gear_type]}}</td>
                                    <td>{{$selectBoxValues[3][$car->fuel_type]}}</td>
                                    <td>{{Str::limit($car->getDamages->description, 20)}}</td>
                                    <td>{{$car->price}}</td>
                                    @if($car->deleted_at == null)
                                        <td>Aktif</td>
                                    @else
                                        <td>Pasif</td>
                                    @endif
                                    <td>
                                        <a href="{{route("car-details", $car)}}" target="_blank" class="btn"><i class="fa-solid fa-arrow-up-right-from-square" style="color: #000000;"></i></a>
                                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-car-id="{{$car->id}}"><i class="fa-solid fa-pen" style="color: #000000;"></i></button>
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <form id="editCarForm">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Araç İlanı Güncelle</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <h4 class="px-3">Araç Başlığı</h4>
                                                                    <input name="title" type="text" class="form-control mt-3 p-3 shadow-none"  style="border-radius: 25px" id="title" placeholder="Başlık giriniz" value="{{$car->title}}" autocomplete="off">
                                                                    @error("title")
                                                                    <p class="m-3 text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mt-3">
                                                                <div class="col-lg-6">
                                                                    <span class="h4 px-3">Araç Markası</span>
                                                                    <select id="brand" name="brand" class="form-control mt-3 shadow-none" style="border-radius: 25px">
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
                                                                <div class="col-lg-6 mt-3 mt-lg-0">
                                                                    <span class="h4 px-3">Araç Modeli</span>
                                                                    <select id="model" name="model" class="form-control mt-3 shadow-none" data-selected-model="{{$car->getModels->id}}" style="border-radius: 25px">
                                                                        <!-- Mevcut model seçili olacak -->
                                                                        <option value="{{$car->getModels->id}}" selected>{{$car->getModels->name}}</option>
                                                                    </select>
                                                                    @error("model")
                                                                    <p class="m-3 text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mt-3">
                                                                <div class="col-lg-6">
                                                                    <span class="h4 px-3">Araç Yılı</span>
                                                                    <input name="year" type="date" class="form-control mt-3 p-3 shadow-none"  style="border-radius: 25px" id="year" placeholder="Başlık giriniz" value="{{$car->year}}" autocomplete="off">
                                                                    @error("year")
                                                                    <p class="m-3 text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-lg-6 mt-3 mt-lg-0">
                                                                    <span class="h4 px-3 ">Araç Rengi</span>
                                                                    <select id="color" class="form-control mt-3 shadow-none" name="color" style="border-radius: 25px">
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

                                                            <div class="row mt-3">
                                                                <div class="col-lg-6">
                                                                    <span class="h4 px-3">Araç Kilometresi</span>
                                                                    <div class="input-group">
                                                                        <input name="km" type="text" class="form-control mt-3 p-3 shadow-none"  style="border-radius: 25px" id="km" placeholder="Kilometre giriniz" value="{{$car->km}}" autocomplete="off">
                                                                        <span class="input-group-text border-0 mt-3" style="border-radius: 25px">KM</span>
                                                                    </div>
                                                                    @error("km")
                                                                    <p class="m-3 text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-lg-6 mt-3 mt-lg-0">
                                                                    <span class="h4 px-3 ">Araç Garantisi</span>
                                                                    <select id="guarantee" class="form-control mt-3 shadow-none" name="guarantee" style="border-radius: 25px">
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

                                                            <div class="row mt-3">
                                                                <div class="col-lg-6">
                                                                    <span class="h4 px-3">Araç Vites Türü</span>
                                                                    <select id="gear-type" class="form-control mt-3 shadow-none" name="gear-type" style="border-radius: 25px">
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
                                                                <div class="col-lg-6 mt-3 mt-lg-0">
                                                                    <span class="h4 px-3 ">Araç Yakıt Türü</span>
                                                                    <select id="fuel-type" class="form-control mt-3 shadow-none" name="fuel-type" style="border-radius: 25px">
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

                                                            <div class="row mt-3">
                                                                <div class="col-lg-6">
                                                                    <h4 class="px-3">Araç Açıklaması</h4>
                                                                    <textarea name="description" class="form-control mt-3 p-3 shadow-none" rows="3" style="border-radius: 25px" id="description" placeholder="Açıklama giriniz" autocomplete="off">{{$car->description}}</textarea>
                                                                    @error("description")
                                                                    <p class="m-3 text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-lg-6 mt-3 mt-lg-0">
                                                                    <span class="h4 px-3">Araç Hasarı</span>
                                                                    <textarea name="damage-description" class="form-control mt-3 p-3 shadow-none" rows="3" style="border-radius: 25px" id="damage-description" placeholder="Açıklama giriniz" autocomplete="off">{{$car->getDamages->description}}</textarea>
                                                                    @error("damage-description")
                                                                    <p class="m-3 text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mt-3">
                                                                <div class="col-lg-6">
                                                                    <span class="h4 px-3">İlan Durumu</span>
                                                                    <select id="status" name="status" class="form-control mt-3 shadow-none" style="border-radius: 25px">
                                                                        <option value="0" selected>Aktif</option>
                                                                        <option value="1">Pasif</option>
                                                                    </select>
                                                                    @error("status")
                                                                    <p class="m-3 text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-lg-6 mt-3 mt-lg-0">
                                                                    <span class="h4 px-3">Araç Fiyatı</span>
                                                                    <div class="input-group mb-3">
                                                                        <input id="price" type="text" name="price" class="form-control mt-3 p-3 shadow-none" placeholder="Fiyat Giriniz" aria-label="Amount (to the nearest dollar)" style="border-radius: 25px" value="{{$car->price}}" autocomplete="off">
                                                                        <span class="input-group-text border-0 mt-3" style="border-radius: 25px">₺</span>
                                                                    </div>
                                                                    @error("price")
                                                                    <p class="m-3 text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="spinner-border d-none" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                                                            <button id="editCarButton" type="submit" class="btn btn-success border-0" style="background-color: #a4c639">Güncelle</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
                    fetch("{{route("getCar")}}", {
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
                            document.getElementById('title').value = data.title;
                            document.getElementById('year').value = data.year;
                            document.getElementById('color').value = data.color;
                            document.getElementById('km').value = data.km;
                            document.getElementById('guarantee').value = data.guarantee;
                            document.getElementById('gear-type').value = data.gear_type;
                            document.getElementById('fuel-type').value = data.fuel_type;
                            document.getElementById('description').value = data.description;
                            document.getElementById('damage-description').value = data.damage_description;
                            document.getElementById('status').value = data.deleted_at ? '1' : '0';
                            document.getElementById('price').value = data.price;

                            $(document).ready(function() {
                                var selectedBrandID = data.brand;
                                var selectedModelID = data.model;

                                function filterModels(brandID, selectedModelID = null) {
                                    if (brandID) {
                                        $.ajax({
                                            type: 'GET',
                                            url: '/sellCarModelFilter/' + brandID,
                                            success: function(data) {
                                                $('#model').empty();
                                                $.each(data, function(index, model) {
                                                    var selected = model.id == selectedModelID ? 'selected' : '';
                                                    $('#model').append('<option value="' + model.id + '" ' + selected + '>' + model.name + '</option>');
                                                });
                                            }
                                        });
                                    }
                                }

                                if (selectedBrandID) {
                                    $('#brand').val(selectedBrandID).change();
                                    filterModels(selectedBrandID, selectedModelID);
                                }

                                $('#brand').change(function() {
                                    var brandID = $(this).val();
                                    filterModels(brandID);
                                });
                            });
                        } else {
                            alert("Bir hata oluştu, lütfen tekrar deneyin.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
                });
            });

            document.getElementById("editCarButton").addEventListener("click", function(e) {
                e.preventDefault()
                if (carID) {
                    fetch("{{ route('admin.editCar') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            car_id: carID,
                            title: document.getElementById('title').value,
                            brand: document.getElementById('brand').value,
                            model: document.getElementById('model').value,
                            year: document.getElementById('year').value,
                            color: document.getElementById('color').value,
                            km: document.getElementById('km').value,
                            guarantee: document.getElementById('guarantee').value,
                            gear_type: document.getElementById('gear-type').value,
                            fuel_type: document.getElementById('fuel-type').value,
                            description: document.getElementById('description').value,
                            damage_description: document.getElementById('damage-description').value,
                            status: document.getElementById('status').value,
                            price: document.getElementById('price').value,
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
