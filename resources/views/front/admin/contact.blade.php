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
        white-space: normal;
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
                                <a href="{{route("admin.contact")}}" class="nav-link active" style="background-color: #a4c639">
                                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                                    Destek
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 px-5">
                    <h2 class="px-3 pt-3">Destek</h2>
                    <div class="table-responsive px-3">
                        <table class="table table-hover mt-5" style="--bs-table-bg: transparent;">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Ad Soyad</th>
                                <th scope="col">E-Posta</th>
                                <th scope="col">Konu</th>
                                <th scope="col">Mesaj</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <th scope="row">{{$contact->id}}</th>
                                    <td>{{$contact->name_surname}}</td>
                                    <td> {{$contact->email}}</td>
                                    @if($contact->topic)
                                        <td>{{Str::limit($contact->topic, 25)}}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    <td>{{Str::limit($contact->message, 25)}}</td>
                                    <td>
                                        <button type="button" class="btn btn-success border-0" data-bs-toggle="modal" data-bs-target="#exampleModal" data-message-id="{{$contact->id}}" style="background-color: #a4c639">Tümünü Gör</button>
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <form id="editBlogForm">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mesaj Detayı</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <h4 class="px-3 text-center"><span id="name_surname">{{$contact->name_surname}}</span></h4>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-4">
                                                                <div class="col-lg-12">
                                                                    <h6 class="px-3"><b>E-Posta:</b> <span id="email">{{$contact->email}}</span> </h6>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-3">
                                                                <div class="col-lg-12">
                                                                    <h6 class="px-3"><b>Konu:</b> <span id="topic">{{$contact->topic}}</span> </h6>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-3">
                                                                <div class="col-lg-12">
                                                                    <h6 class="px-3"><b>Mesaj:</b> <span id="message">{{$contact->message}}</span></h6>
                                                                </div>
                                                            </div>
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
            let messageID;

            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    messageID = this.getAttribute('data-message-id');
                    fetch("{{route("getMessage")}}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            message_id: messageID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log(data.name_surname)
                            document.getElementById('name_surname').textContent = data.name_surname;
                            document.getElementById('email').textContent = data.email;
                            document.getElementById('topic').textContent = data.topic ? data.topic : '-';
                            document.getElementById('message').textContent = data.message;
                        } else {
                            alert("Bir hata oluştu, lütfen tekrar deneyin.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
                });
            });
        });
    </script>

@endsection
