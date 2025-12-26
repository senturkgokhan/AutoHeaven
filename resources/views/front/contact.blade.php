@extends("front.layouts.app")

@section("content")
    <!-- Page Content -->
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Bize Ulaşın</h1>
                    <span>İletişime Geçmek İçin Arayın!</span>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-information">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-item">
                        <i class="fa fa-phone"></i>
                        <h4>Telefon</h4>
                        <p>Hızlı ve Kolay İletişim!</p>
                        <a href="tel:1234567890">123-456-7890</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-item">
                        <i class="fa fa-envelope"></i>
                        <h4>Email</h4>
                        <p>Maille Bize Ulaşın!</p>
                        <a href="mailto:autoheaven@company.com">autoheaven@company.com</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-item">
                        <i class="fa fa-map-marker"></i>
                        <h4>Konum</h4>
                        <p>Üniversite, Fırat Ünv., 23200 Elâzığ Merkez/Elazığ</p>
                        <a href="https://www.google.com/maps?ll=38.677757,39.201956&z=16&t=m&hl=tr&gl=TR&mapclient=embed&cid=10942151332663835802" target="_blank">Google Maps'te İncele</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="callback-form contact-us">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Bize bir mesaj <em>gönder</em></h2>
                        <span>Mesajınızı Bırakın, İlgilenelim!</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="contact-form">
                        <form id="contact" action="{{route("sendMessage")}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="name_surname" type="text" class="form-control" id="name_surname" placeholder="Ad Soyad" autocomplete="off">
                                    </fieldset>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="email" type="text" class="form-control" id="email" pattern="[^ @]*@[^ @]*" placeholder="E-Posta" autocomplete="off">
                                    </fieldset>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="topic" type="text" class="form-control" id="topic" placeholder="Konu" autocomplete="off">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <textarea name="message" rows="6" class="form-control" id="message" placeholder="Mesajınız" autocomplete="off"></textarea>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="filled-button">Mesaj Gönder</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="map">
        <!-- How to change your own map point
            1. Go to Google Maps
            2. Click on your location point
            3. Click "Share" and choose "Embed map" tab
            4. Copy only URL and paste it within the src="" field below
        -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3114.743565019874!2d39.19938067544026!3d38.67776105963472!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4076c043f0ec934d%3A0x97da54a9bdfebc9a!2zRsSxcmF0IMOcbml2ZXJzaXRlc2k!5e0!3m2!1str!2str!4v1727955243141!5m2!1str!2str" width="100%" height="500px" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
@endsection
