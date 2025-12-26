@extends("front.layouts.app")

@section("content")
    <!-- Page Content -->
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Hakkımızda</h1>
                    <span>20 yılı aşkın deneyime sahibiz</span>
                </div>
            </div>
        </div>
    </div>

    <div class="more-info about-info">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="more-info-content">
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <div class="right-content">
                                    <h2>Şirketimiz hakkında <em>bilgi edinin</em></h2>
                                    <p>Şirketimiz, araç alım satım sürecinde müşterilerimize en yüksek kalite ve güvenceyi sağlamayı taahhüt eder. Tüm araçlarımız, kapsamlı bir denetimden geçirilmiş ve kalite standartlarımıza uygun olarak sunulmaktadır. Müşteri memnuniyeti bizim için önceliklidir ve satış sonrası destek hizmetlerimizle her zaman yanınızdayız. Güvenilir ve şeffaf hizmet anlayışımızla, aracınızı güvenle seçebilir ve satın alabilirsiniz.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="left-image">
                                    <img src="{{asset("assets/images/about-1-570x350.jpg")}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fun-facts">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-content">
                        <h2>İlerleme Yolculuğumuz <em>Geçmişten Bugüne Katettiğimiz Mesafe</em></h2>
                        <p>Şirket olarak geçmişten bugüne, müşterilerimize sağladığımız kaliteli hizmet ve sürekli iyileştirme çabalarımızla önemli ilerlemeler kaydettik. Başlangıçtaki vizyonumuzdan aldığımız ilhamla, her adımda daha iyiye doğru ilerledik. Müşteri memnuniyetini odak noktamız olarak belirleyerek, sunduğumuz ürün ve hizmetlerde sürekli olarak yenilik ve gelişime açık olduk.</p>
                    </div>
                </div>
                <div class="col-md-6 align-self-center">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="count-area-content">
                                <div class="count-digit">100000</div>
                                <div class="count-title">Kilometre kat edildi</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="count-area-content">
                                <div class="count-digit">1280</div>
                                <div class="count-title">Mutlu müşteri</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="count-area-content">
                                <div class="count-digit">12</div>
                                <div class="count-title">Şehir</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="count-area-content">
                                <div class="count-digit">26</div>
                                <div class="count-title">Araba</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
