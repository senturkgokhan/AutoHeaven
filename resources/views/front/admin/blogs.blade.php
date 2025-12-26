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
                                <a href="{{route("carDamages")}}" class="nav-link link-dark">
                                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                                    Araba Hasarları
                                </a>
                            </li>
                            <li>
                                <a href="{{route("blogs")}}" class="nav-link active" style="background-color: #a4c639">
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
                    <h2 class="px-3 pt-3">Bloglar Tablosu</h2>
                    <div class="table-responsive px-3">
                        <table class="table table-hover mt-5" style="--bs-table-bg: transparent;">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Sahip</th>
                                <th scope="col">Başlık</th>
                                <th scope="col">İçerik</th>
                                <th scope="col">Gönderi Durumu</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blogs as $blog)
                                <tr>
                                    <th scope="row">{{$blog->id}}</th>
                                    <td>{{$blog->getUsers->name}} {{$blog->getUsers->surname}}</td>
                                    <td>{{Str::limit($blog->title, 25)}}</td>
                                    <td>{{Str::limit($blog->content, 25)}}</td>
                                    @if($blog->deleted_at == null)
                                        <td>Aktif</td>
                                    @else
                                        <td>Pasif</td>
                                    @endif
                                    <td>
                                        <a href="{{route("blog-details", $blog)}}" target="_blank" class="btn"><i class="fa-solid fa-arrow-up-right-from-square" style="color: #000000;"></i></a>
                                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-blog-id="{{$blog->id}}"><i class="fa-solid fa-pen" style="color: #000000;"></i></button>
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <form id="editBlogForm">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Blog Güncelle</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <h4 class="px-3">Blog Başlığı</h4>
                                                                    <input name="title" type="text" class="form-control mt-3 p-3"  style="border-radius: 25px" id="title" placeholder="Başlık giriniz" autocomplete="off" value="{{$blog->title}}">
                                                                </div>
                                                            </div>

                                                            <div class="row mt-3">
                                                                <div class="col-lg-12">
                                                                    <h4 class="px-3">Blog İçeriği</h4>
                                                                    <textarea name="content" class="form-control mt-3 p-3 shadow-none" rows="5" style="border-radius: 25px" id="content" placeholder="İçerik giriniz" autocomplete="off">{{$blog->content}}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-3">
                                                                <div class="col-lg-12">
                                                                    <span class="h4 px-3">Gönderi Durumu</span>
                                                                    <select id="status" name="status" class="form-control mt-3 shadow-none" style="border-radius: 25px">
                                                                        <option value="0" selected>Aktif</option>
                                                                        <option value="1">Pasif</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                                                            <button id="editBlogButton" type="submit" class="btn btn-success border-0" style="background-color: #a4c639">Güncelle</button>
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
            let blogID;

            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    blogID = this.getAttribute('data-blog-id');
                    console.log(blogID)
                    fetch("{{route("getBlog")}}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            blog_id: blogID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('title').value = data.title;
                            document.getElementById('content').value = data.content;
                            document.getElementById('title').value = data.title;
                            document.getElementById('status').value = data.deleted_at ? '1' : '0';
                        } else {
                            alert("Bir hata oluştu, lütfen tekrar deneyin.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
                });
            });

            document.getElementById("editBlogButton").addEventListener("click", function(e) {
                e.preventDefault()
                if (blogID) {
                    fetch("{{ route('admin.editBlog') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            blog_id: blogID,
                            title: document.getElementById('title').value,
                            content: document.getElementById('content').value,
                            status: document.getElementById('status').value,
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
