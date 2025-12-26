@extends("front.layouts.app")

@section("content")
    <!-- Page Content -->
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Arabalar</h1>
                    <span>Yeni ve İkinci El Arabalar İçin!</span>
                </div>
            </div>
        </div>
    </div>

    <div class="services">
        <div class="container">
            <form action="#" id="contact">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Marka:</label>

                            <select id="brand" name="brand" class="form-control">
                                <option value="0" selected>Lütfen Marka Seçiniz</option>
                                @foreach($carBrands as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Yıl:</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="date" id="year-start" name="year-start" class="form-control" placeholder="Başlangıç" autocomplete="off">
                                </div>
                                <div class="col-6">
                                    <input type="date" id="year-end" name="year-end" class="form-control" placeholder="Bitiş" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Renk:</label>

                            <select id="color" name="color" class="form-control">
                                <option value="0" selected>Lütfen Renk Seçiniz</option>
                                <option value="1">Beyaz</option>
                                <option value="2">Siyah</option>
                                <option value="3">Gri</option>
                                <option value="4">Gümüş</option>
                                <option value="5">Mavi</option>
                                <option value="6">Kırmızı</option>
                                <option value="7">Diğer</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Kilometre:</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" id="km-start" name="km-start" class="form-control" placeholder="Başlangıç" autocomplete="off">
                                </div>
                                <div class="col-6">
                                    <input type="text" id="km-end" name="km-end" class="form-control" placeholder="Bitiş" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Garanti:</label>

                            <select id="guarantee" name="guarantee" class="form-control">
                                <option value="0" selected>Lütfen Garanti Seçiniz</option>
                                <option value="1">Var</option>
                                <option value="2">Yok</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Vites Türü:</label>

                            <select id="gear-type" name="gear-type" class="form-control">
                                <option value="0" selected>Lütfen Vites Türü Seçiniz</option>
                                <option value="1">Manuel</option>
                                <option value="2">Otomatik</option>
                                <option value="2">Yarı-Otomatik</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Yakıt Türü:</label>

                            <select id="fuel-type" name="fuel-type" class="form-control">
                                <option value="0" selected>Lütfen Yakıt Türü Seçiniz</option>
                                <option value="1">Benzin</option>
                                <option value="2">Dizel</option>
                                <option value="2">LPG</option>
                                <option value="2">Elektrik</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Fiyat:</label>

                            <div class="row">
                                <div class="col-6">
                                    <input type="text" id="price-start" name="price-start" class="form-control" placeholder="Başlangıç" autocomplete="off">
                                </div>
                                <div class="col-6">
                                    <input type="text" id="price-end" name="price-end" class="form-control" placeholder="Bitiş" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 offset-sm-4">
                    <div class="main-button text-center">
                        <button id="filterCarsButton" class="filled-button border-0">Ara</button>
                    </div>
                </div>
                <br>
                <br>
            </form>

            <div class="row mb-5" id="car-list">
                @for($i = 0; $i < count($cars); $i++)
                    <div class="col-md-4">
                        <div class="service-item">
                            @if($cars[$i]->media == null)
                                <img src="{{ asset('assets/images/no-car.jpg') }}" alt="">
                            @else
                                <img src="{{ asset('assets/images/'.$cars[$i]->media) }}" alt="">
                            @endif
                            <div class="down-content">
                                <h4>{{$cars[$i]->title}}</h4>
                                <div style="margin-bottom:10px;">
                                  <span>
                                      <sup>₺</sup>{{$cars[$i]->price}}
                                  </span>
                                </div>
                                <p>
                                    <i class="fa fa-dashboard"></i> {{$cars[$i]->km}} &nbsp;&nbsp;&nbsp;
                                    <i class="fa fa-cog"></i> {{$gearTypes[$cars[$i]->gear_type]}}
                                </p>
                                <a href="car-details/{{$cars[$i]->id}}" class="filled-button">İncele</a>
                            </div>
                        </div>
                        <br>
                    </div>
                @endfor
                <nav id="pagination-nav" class="my-5">
                    <ul id="pagination" class="pagination pagination-lg justify-content-center">
                        <li class="page-item {{ $cars->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{$cars->previousPageUrl()}}" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        @for($i = 1; $i <= $cars->lastPage(); $i++)
                            <li class="page-item {{ $i == $cars->currentPage() ? 'disabled' : '' }}"><a class="page-link" href="{{$cars->url($i)}}">{{$i}}</a></li>
                        @endfor
                        <li class="page-item {{ !$cars->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{$cars->nextPageUrl()}}" aria-label="Next">
                                <span aria-hidden="true">»</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("filterCarsButton").addEventListener("click", function(e) {
            e.preventDefault();

            const brand = document.getElementById("brand").value;
            const yearStart = document.getElementById("year-start").value;
            const yearEnd = document.getElementById("year-end").value;
            const color = document.getElementById("color").value;
            const kmStart = document.getElementById("km-start").value;
            const kmEnd = document.getElementById("km-end").value;
            const guarantee = document.getElementById("guarantee").value;
            const gearType = document.getElementById("gear-type").value;
            const fuelType = document.getElementById("fuel-type").value;
            const priceStart = document.getElementById("price-start").value;
            const priceEnd = document.getElementById("price-end").value;

            function filterCars(page = 1) {
                fetch("{{ route('filterCars') }}?page=" + page, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        brand: brand,
                        yearStart: yearStart,
                        yearEnd: yearEnd,
                        color: color,
                        kmStart: kmStart,
                        kmEnd: kmEnd,
                        guarantee: guarantee,
                        gearType: gearType,
                        fuelType: fuelType,
                        priceStart: priceStart,
                        priceEnd: priceEnd
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const carList = document.getElementById("car-list");
                        carList.innerHTML = "";

                        if (data.cars.length > 0) {
                            data.cars.forEach(car => {
                                const carItem = `
                                    <div class="col-md-4">
                                        <div class="service-item">
                                            <img src="{{ asset('assets/images') }}/${car.media ? car.media : 'no-car.jpg'}" alt="">
                                            <div class="down-content">
                                                <h4>${car.title}</h4>
                                                <div style="margin-bottom:10px;">
                                                    <span>
                                                        <sup>₺</sup>${car.price}
                                                    </span>
                                                </div>
                                                <p>
                                                    <i class="fa fa-dashboard"></i> ${car.km} &nbsp;&nbsp;&nbsp;
                                                    <i class="fa fa-cog"></i> ${data.gearTypes[car.gear_type]}
                                                </p>
                                                <a href="car-details/${car.id}" class="filled-button">İncele</a>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                `;
                                carList.innerHTML += carItem;
                            });
                        } else {
                            carList.innerHTML = "<h2 class='text-center' style='opacity: 25%'>Fitrelenmiş araç bulunamadı.</h2>";
                        }

                        let pagination = `
                            <nav class="my-5">
                                <ul class="pagination pagination-lg justify-content-center">
                                    <li class="page-item ${data.pagination.currentPage === 1 ? 'disabled' : ''}">
                                        <a class="page-link" href="#" data-page="${data.pagination.currentPage - 1}" aria-label="Previous">
                                            <span aria-hidden="true">«</span>
                                        </a>
                                    </li>
                        `;

                        for (let i = 1; i <= data.pagination.lastPage; i++) {
                            pagination += `
                                    <li class="page-item ${i === data.pagination.currentPage ? 'disabled' : ''}">
                                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                                    </li>
                            `;
                        }

                        pagination += `
                                    <li class="page-item ${data.pagination.currentPage === data.pagination.lastPage ? 'disabled' : ''}">
                                        <a class="page-link" href="#" data-page="${data.pagination.currentPage + 1}" aria-label="Next">
                                            <span aria-hidden="true">»</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        `;

                        carList.innerHTML += pagination;

                        document.querySelectorAll(".pagination a").forEach(link => {
                            link.addEventListener("click", function(e) {
                                e.preventDefault();
                                const page = this.getAttribute("data-page");
                                filterCars(page);
                            });
                        });
                    }
                })
                .catch(error => console.error("Error:", error));
            }

            filterCars();
        });
    </script>
@endsection
