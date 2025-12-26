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
                                <a href="{{route("admin")}}" class="nav-link link-dark">
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
                                <a href="{{route("brandModel")}}" class="nav-link link-dark">
                                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                                    Araba Marka/Modelleri
                                </a>
                            </li>
                            <li>
                                <a href="{{route("carDamages")}}" class="nav-link active" style="background-color: #a4c639">
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
                    <h2 class="px-3 pt-3">Araba Hasarları Tablosu</h2>
                    <div class="table-responsive px-3">
                        <table class="table table-hover mt-5" style="--bs-table-bg: transparent;">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Sahip</th>
                                <th scope="col">İlan Başlığı</th>
                                <th scope="col">Açıklama</th>
                                <th scope="col">İlan Durumu</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($carDamages as $carDamage)
                                <tr>
                                    <th scope="row">{{$carDamage->id}}</th>
                                    @php
                                        $car = $carDamage->getCars->first();
                                        $owner = $car ? $car->getUsers->name.' '.$car->getUsers->surname : "Sahip bulunamadı";
                                        $title = $car ? $car->title : 'Başlık bulunamadı';
                                        $status = $car ? 'Aktif' : "Pasif";
                                    @endphp
                                    <td>{{$owner}}</td>
                                    <td>{{$title}}</td>
                                    @if($carDamage->description == null)
                                        <td>-</td>
                                    @else
                                        <td>{{Str::limit($carDamage->description, 50)}}</td>
                                    @endif
                                    <td>{{$status}}</td>
                                    <td>
                                        <a href="{{route("car-details", $carDamage)}}" target="_blank" class="btn"><i class="fa-solid fa-arrow-up-right-from-square" style="color: #000000;"></i></a>
                                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-car-damage-id="{{$carDamage->id}}"><i class="fa-solid fa-pen" style="color: #000000;"></i></button>
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <form id="editCarDamageForm">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hasar Açıklaması Güncelle</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row my-3">
                                                                <div class="col-lg-12">
                                                                    <h4 class="px-3">Hasar Açıklaması</h4>
                                                                    <textarea name="damage_description" class="form-control mt-3 p-3 shadow-none" rows="3" style="border-radius: 25px" id="damage_description" placeholder="Açıklama giriniz" autocomplete="off">{{$carDamage->description}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                                                            <button id="editCarDamageButton" type="submit" class="btn btn-success border-0" style="background-color: #a4c639">Güncelle</button>
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
            let carDamageID;

            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    carDamageID = this.getAttribute('data-car-damage-id');
                    fetch("{{route("getCarDamage")}}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            car_damage_id: carDamageID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('damage_description').value = data.damage_description;
                        } else {
                            alert("Bir hata oluştu, lütfen tekrar deneyin.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
                });
            });

            document.getElementById("editCarDamageButton").addEventListener("click", function(e) {
                e.preventDefault()
                if (carDamageID) {
                    fetch("{{ route('editCarDamage') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            car_damage_id: carDamageID,
                            damage_description: document.getElementById('damage_description').value
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
