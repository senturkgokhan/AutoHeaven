@extends("front.layouts.app")

@section("content")
    <!-- Page Content -->
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Takım</h1>
                    <span>Profesyonel ekip arkadaşlarımız</span>
                </div>
            </div>
        </div>
    </div>

    <div class="team" style="margin: 0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Ekip <em>üyelerimiz</em></h2>
                        <span>Ekip Üyelerimizi Tanıyın</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-item">
                        <img src="{{asset("assets/images/team-image-1-646x680.jpg")}}" alt="">
                        <div class="down-content">
                            <h4>Alperen Aktaş</h4>
                            <span>Junior Web Developer</span>
                            <p>Merhaba, ben Alperen. Yeniliklere ve öğrenmeye açığım. Takım çalışmasına ve projelerde yer almaya hazırım!</p>

                            <p>
                                <a href="https://www.linkedin.com/in/aktasalperen0/" target="_blank"><span><i class="fa fa-linkedin"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-item">
                        <img src="{{asset("assets/images/team-image-1-646x680.jpg")}}" alt="">
                        <div class="down-content">
                            <h4>Muhammed Gökhan Şentürk</h4>
                            <span>Junior Software Developer</span>
                            <p>...</p>
                            <p>
                                <a href="https://www.linkedin.com/in/g%C3%B6khan-%C5%9Fent%C3%BCrk-5779a425b/" target="_blank"><span><i class="fa fa-linkedin"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
