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
                                <a href="{{route("admin")}}" class="nav-link active" aria-current="page" style="background-color: #a4c639">
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
                    <h2 class="px-3 pt-3">Kullanıcılar Tablosu</h2>
                    <div class="table-responsive px-3">
                        <table class="table table-hover mt-5" style="--bs-table-bg: transparent;">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Ad</th>
                                <th scope="col">Soyad</th>
                                <th scope="col">Rol</th>
                                <th scope="col">E-Posta</th>
                                <th scope="col">Telefon</th>
                                <th scope="col">İş</th>
                                <th scope="col">Biyografi</th>
                                <th scope="col">Hesap Durumu</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->surname}}</td>
                                    @if($user->role == 0)
                                        <td>Yönetici</td>
                                    @else
                                        <td>Satıcı</td>
                                    @endif
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    @if($user->job)
                                        <td>{{$user->job}}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    @if($user->bio)
                                        <td>{{Str::limit($user->bio, 25)}}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    @if($user->deleted_at == null)
                                        <td>Aktif</td>
                                    @else
                                        <td>Pasif</td>
                                    @endif
                                    <td>
                                        <a href="{{route("profile", $user)}}" target="_blank" class="btn"><i class="fa-solid fa-arrow-up-right-from-square" style="color: #000000;"></i></a>
                                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-user-id="{{$user->id}}"><i class="fa-solid fa-pen" style="color: #000000;"></i></button>
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <form id="editUserForm">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Kullanıcı Güncelle</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <h4 class="px-3">Ad</h4>
                                                                    <input name="name" type="text" class="form-control mt-3 p-3"  style="border-radius: 25px" id="name" placeholder="Ad giriniz" value="{{$user->name}}" autocomplete="off">
                                                                    @error("name")
                                                                    <p class="m-3 text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-lg-6 mt-3 mt-lg-0">
                                                                    <span class="h4 px-3">Soyad</span>
                                                                    <input name="surname" type="text" class="form-control mt-3 p-3"  style="border-radius: 25px" id="surname" placeholder="Soyad giriniz" value="{{$user->surname}}" autocomplete="off">
                                                                    @error("surname")
                                                                    <p class="m-3 text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mt-3">
                                                                <div class="col-lg-6">
                                                                    <h4 class="px-3">E-Posta</h4>
                                                                    <input name="email" type="email" class="form-control mt-3 p-3 shadow-none"  style="border-radius: 25px" id="email" placeholder="E-Posta giriniz" value="{{$user->email}}" autocomplete="off">
                                                                    @error("name")
                                                                    <p class="m-3 text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-lg-6 mt-3 mt-lg-0">
                                                                    <span class="h4 px-3">Telefon</span>
                                                                    <input name="phone" type="tel" class="form-control mt-3 p-3 shadow-none"  style="border-radius: 25px" id="phone" placeholder="Telefon numarası giriniz" value="{{$user->phone}}" autocomplete="off">
                                                                    @error("phone")
                                                                    <p class="m-3 text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mt-3">
                                                                <div class="col-lg-6">
                                                                    <span class="h4 px-3">Rol</span>
                                                                    <select id="role" name="role" class="form-control mt-3 shadow-none" style="border-radius: 25px">
                                                                        <option value="0" selected>Yönetici</option>
                                                                        <option value="1">Satıcı</option>
                                                                    </select>
                                                                    @error("role")
                                                                    <p class="m-3 text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-lg-6 mt-3 mt-lg-0">
                                                                    <span class="h4 px-3">Hesap Durumu</span>
                                                                    <select id="status" name="status" class="form-control mt-3 shadow-none" style="border-radius: 25px">
                                                                        <option value="0" selected>Aktif</option>
                                                                        <option value="1">Pasif</option>
                                                                    </select>
                                                                    @error("status")
                                                                    <p class="m-3 text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mt-3">
                                                                <div class="col-lg-6">
                                                                    <span class="h4 px-3">İş</span>
                                                                    <input name="job" type="text" class="form-control mt-3 p-3 shadow-none"  style="border-radius: 25px" id="job" placeholder="İş giriniz" value="{{$user->job}}" autocomplete="off">
                                                                    @error("job")
                                                                    <p class="m-3 text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-lg-6 mt-3 mt-lg-0">
                                                                    <h4 class="px-3">Biyografi</h4>
                                                                    <textarea name="bio" class="form-control mt-3 p-3 shadow-none" style="border-radius: 25px" id="bio" placeholder="Kendinizi tanıtın" autocomplete="off">{{$user->bio}}</textarea>
                                                                    @error("bio")
                                                                    <p class="m-3 text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                                                            <button id="editUserButton" type="submit" class="btn btn-success border-0" style="background-color: #a4c639">Güncelle</button>
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
            let userID;

            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    userID = this.getAttribute('data-user-id');
                    fetch("{{route("getUser")}}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            user_id: userID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('name').value = data.name;
                            document.getElementById('surname').value = data.surname;
                            document.getElementById('email').value = data.email;
                            document.getElementById('phone').value = data.phone;
                            document.getElementById('role').value = data.role === 0 ? '0' : '1';
                            document.getElementById('status').value = data.deleted_at ? '1' : '0';
                            document.getElementById('job').value = data.job || '';
                            document.getElementById('bio').value = data.bio || '';
                        } else {
                            alert("Bir hata oluştu, lütfen tekrar deneyin.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
                });
            });

            document.getElementById("editUserButton").addEventListener("click", function(e) {
                e.preventDefault()
                if (userID) {
                    fetch("{{ route('editUser') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            user_id: userID,
                            name: document.getElementById('name').value,
                            surname: document.getElementById('surname').value,
                            email: document.getElementById('email').value,
                            phone: document.getElementById('phone').value,
                            role: document.getElementById('role').value,
                            status: document.getElementById('status').value,
                            job: document.getElementById('job').value,
                            bio: document.getElementById('bio').value
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
