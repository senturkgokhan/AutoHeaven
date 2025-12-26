@extends("front.layouts.app")

@section("content")
    <!-- Page Content -->
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Görüşler</h1>
                    <span>Görüşleriniz Bizim İçin Değerlidir</span>
                </div>
            </div>
        </div>
    </div>

    <div class="testimonials" style="margin: 0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-testimonials owl-carousel">

                        <div class="testimonial-item">
                            <div class="inner-content">
                                <h4>Ali Yılmaz</h4>
                                <span>Yazılım Mühendisi</span>
                                <p>"Bu site sayesinde aradığım aracı hızlıca buldum ve tüm detaylara kolayca eriştim. Kullanıcı dostu arayüzü ve geniş araç seçenekleri harika!"</p>
                            </div>
                            <img src="{{asset("assets/images/team-image-1-646x680.jpg")}}" alt="">
                        </div>

                        <div class="testimonial-item">
                            <div class="inner-content">
                                <h4>Ayşe Kaya</h4>
                                <span>Grafik Tasarımcı</span>
                                <p>"Araç seçenekleri çok fazla ve fiyatlar oldukça makul. Ayrıca, sitenin filtreleme sistemi de çok pratik!"</p>
                            </div>
                            <img src="{{asset("assets/images/team-image-2-646x680.jpg")}}" alt="">
                        </div>

                        <div class="testimonial-item">
                            <div class="inner-content">
                                <h4>Mehmet Demir</h4>
                                <span>Proje Yöneticisi</span>
                                <p>"Site üzerinde gezinmek çok kolay ve araçlar hakkında detaylı bilgi alabiliyorsunuz. Güvenilir ve kullanışlı bir platform!"</p>
                            </div>
                            <img src="{{asset("assets/images/team-image-3-646x680.jpg")}}" alt="">
                        </div>

                        <div class="testimonial-item">
                            <div class="inner-content">
                                <h4>Fatma Çelik</h4>
                                <span>Veri Analisti</span>
                                <p>"Bu site sayesinde aradığım aracı hızlıca buldum ve tüm detaylara kolayca eriştim. Kullanıcı dostu arayüzü ve geniş araç seçenekleri harika!"</p>
                            </div>
                            <img src="{{asset("assets/images/team-image-2-646x680.jpg")}}" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
