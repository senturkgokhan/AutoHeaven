@extends("front.layouts.app")

<style>
    .table td, .table th {
        white-space: nowrap;
    }

    .nav-pills .nav-link:hover{
        background-color: rgba(0, 0, 0, 0.075);
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
                                <a href="{{route("admin")}}" class="nav-link link-dark" aria-current="page">
                                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                                    Kullanıcılar
                                </a>
                            </li>
                            <li>
                                <a href="{{route("admin.cars")}}" class="nav-link link-dark">
                                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                                    Arabalar
                                </a>
                            </li>
                            <li>
                                <a href="{{route("brandModel")}}" class="nav-link active" style="background-color: #a4c639">
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
                    @if(session("success"))
                        <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
                            {{session("success")}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-6">
                            <h2 class="px-3 pt-3">Modeller Tablosu<span class="float-right"><button type="button" class="btn btn-success border-0" style="background-color: #a4c639" data-bs-toggle="modal" data-bs-target="#exampleModal4"><i class="fa-solid fa-plus"></i></button></span></h2>
                            <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <form action="{{route("addModel")}}" method="post">
                                            @csrf
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Model Ekle</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <span class="h4 px-3">Araç Markası</span>
                                                        <select id="brand_4" name="brand_4" class="form-control mt-3 shadow-none" style="border-radius: 25px">
                                                            <option value="0" selected disabled>Lütfen Marka Seçiniz</option>
                                                            @foreach($carBrands as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error("brand")
                                                        <p class="m-3 text-danger">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-12">
                                                        <h4 class="px-3">Model Adı</h4>
                                                        <input name="model_4" type="text" class="form-control mt-3 p-3"  style="border-radius: 25px" id="model_4" placeholder="Model giriniz" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                                                <button id="addModel Button" type="submit" class="btn btn-success border-0" style="background-color: #a4c639">Ekle</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive px-3">
                                <table class="table table-hover mt-5" style="--bs-table-bg: transparent;">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Marka</th>
                                        <th scope="col">Model</th>
                                        <th scope="col">İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($carModels as $carModel)
                                        <tr>
                                            <th scope="row">{{$carModel->id}}</th>
                                            <td>{{$carModel->getBrands->name}}</td>
                                            <td>{{$carModel->name}}</td>
                                            <td>
                                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-model-id="{{$carModel->id}}"><i class="fa-solid fa-pen" style="color: #000000;"></i></button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <form id="editUserForm">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Model Güncelle</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <span class="h4 px-3 ">Marka Adı</span>
                                                                            <select id="brand" class="form-control mt-3 shadow-none" name="brand" style="border-radius: 25px">
                                                                                <option value="{{$carModel->getBrands->id}}" selected>{{$carModel->getBrands->name}}</option>
                                                                                @foreach($carBrands as $carBrand)
                                                                                    @if($carBrand->id == $carModel->getBrands->id)
                                                                                        @continue
                                                                                    @endif
                                                                                    <option value="{{$carBrand->id}}">{{$carBrand->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mt-3">
                                                                        <div class="col-lg-12">
                                                                            <h4 class="px-3">Model Adı</h4>
                                                                            <input name="model" type="text" class="form-control mt-3 p-3"  style="border-radius: 25px" id="model" placeholder="Model giriniz" value="{{$carModel->name}}" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                                                                    <button id="editModelButton" type="submit" class="btn btn-success border-0" style="background-color: #a4c639">Güncelle</button>
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
                        <div class="col-lg-6">
                            <h2 class="px-3 pt-3">Markalar Tablosu<span class="float-right"><button type="button" class="btn btn-success border-0" style="background-color: #a4c639" data-bs-toggle="modal" data-bs-target="#exampleModal3"><i class="fa-solid fa-plus"></i></button></span></h2>
                            <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <form action="{{route("addBrand")}}" method="post">
                                            @csrf
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Marka Ekle</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h4 class="px-3">Marka Adı</h4>
                                                        <input name="brand_3" type="text" class="form-control mt-3 p-3"  style="border-radius: 25px" id="brand_3" placeholder="Marka giriniz" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                                                <button id="addBrandButton" type="submit" class="btn btn-success border-0" style="background-color: #a4c639">Ekle</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive px-3">
                                <table class="table table-hover mt-5" style="--bs-table-bg: transparent;">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Marka</th>
                                        <th scope="col">İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($carBrands as $carBrand)
                                        <tr>
                                            <th scope="row">{{$carBrand->id}}</th>
                                            <td>{{$carBrand->name}}</td>
                                            <td>
                                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-brand-id="{{$carBrand->id}}"><i class="fa-solid fa-pen" style="color: #000000;"></i></button>
                                                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <form id="editUserForm">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Marka Güncelle</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <h4 class="px-3">Marka Adı</h4>
                                                                            <input name="brand_2" type="text" class="form-control mt-3 p-3"  style="border-radius: 25px" id="brand_2" placeholder="Marka giriniz" value="{{$carBrand->name}}" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                                                                    <button id="editBrandButton" type="submit" class="btn btn-success border-0" style="background-color: #a4c639">Güncelle</button>
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
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let modelID;

            document.querySelectorAll('[data-bs-target="#exampleModal"]').forEach(button => {
                button.addEventListener('click', function() {
                    modelID = this.getAttribute('data-model-id');
                    fetch("{{route("getModel")}}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            model_id: modelID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('brand').value = data.brand;
                            document.getElementById('model').value = data.model;
                        } else {
                            alert("Bir hata oluştu, lütfen tekrar deneyin.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
                });
            });

            document.getElementById("editModelButton").addEventListener("click", function(e) {
                e.preventDefault()
                if (modelID) {
                    fetch("{{ route('editModel') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            model_id: modelID,
                            brand: document.getElementById('brand').value,
                            model: document.getElementById('model').value,
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
            let brandID;

            document.querySelectorAll('[data-bs-target="#exampleModal2"]').forEach(button => {
                button.addEventListener('click', function() {
                    brandID = this.getAttribute('data-brand-id');
                    fetch("{{route("getBrand")}}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            brand_id: brandID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('brand_2').value = data.brand;
                        } else {
                            alert("Bir hata oluştu, lütfen tekrar deneyin.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
                });
            });

            document.getElementById("editBrandButton").addEventListener("click", function(e) {
                e.preventDefault()
                if (brandID) {
                    fetch("{{ route('editBrand') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            brand_id: brandID,
                            brand: document.getElementById('brand_2').value,
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
