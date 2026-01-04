<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{asset("assets/images/favicon.png")}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&dispay=swap" rel="stylesheet">

    <title>AutoHeaven</title>

    <link href="{{asset("vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset("assets/css/fontawesome.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/owl.css")}}">

    <style>
        html::-webkit-scrollbar {
            width: 12px;
        }

        html::-webkit-scrollbar-track {
            background: #232323;
        }

        html::-webkit-scrollbar-thumb {
            background-color: #a4c639;
        }
        
        #chat-circle {
        position: fixed;
        bottom: 50px;
        right: 50px;
        background: #8ec63f; 
        width: 60px;
        height: 60px;
        border-radius: 50%;
        color: white;
        padding: 15px;
        cursor: pointer;
        box-shadow: 0px 3px 16px 0px rgba(0, 0, 0, 0.2), 0 3px 1px -2px rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
        z-index: 1000;
    }

    .chat-box {
        display: none;
        background: #efefef;
        position: fixed;
        right: 30px;
        bottom: 50px;
        width: 350px;
        max-width: 85vw;
        max-height: 70vh;
        border-radius: 5px;
        box-shadow: 0px 5px 35px 9px rgba(0,0,0,0.1);
        z-index: 1001;
    }

    .chat-box-header {
        background: #8ec63f;
        height: 50px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        color: white;
        line-height: 50px;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 15px;
    }

    .chat-box-toggle {
        cursor: pointer;
        font-size: 18px;
        color: white;
        transition: color 0.2s ease;
        line-height: 1;
    }

    .chat-box-toggle:hover {
        color: #f0f0f0;
    }

    .chat-box-body {
        position: relative;
        height: 370px;
        overflow-y: auto;
        padding: 15px;
    }

    .cm-msg-text {
        background: white;
        padding: 10px 15px;
        border-radius: 20px;
        margin-bottom: 10px;
        display: inline-block;
        max-width: 80%;
        box-shadow: 2px 2px 5px rgba(0,0,0,0.05);
    }

    .chat-msg.user .cm-msg-text {
        background: #8ec63f;
        color: white;
        float: right;
    }

    .chat-input {
        background: white;
        padding: 10px;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    #chat-input {
        width: 85%;
        border: none;
        outline: none;
    }

    .chat-submit {
        background: transparent;
        border: none;
        color: #8ec63f;
        cursor: pointer;
    }
    </style>
</head>

<body>

<!-- ***** Preloader Start ***** -->
<div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!-- ***** Preloader End ***** -->

<!-- Header -->
<div class="sub-header">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <ul class="left-info">
                    <li><a href="mailto:autoheaven@company.com"><i class="fa fa-envelope"></i>autoheaven@company.com</a></li>
                    <li><a href="tel:1234567890"><i class="fa fa-phone"></i>123-456-7890</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="right-icons">
                    <li><a href="https://facebook.com/"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://x.com/"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{route("index")}}"><h2>Auto<em> Heaven</em></h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route("index")}}">Ana Sayfa
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('cars') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route("cars")}}">Arabalar</a>
                    </li>
                    <li class="nav-item {{ Request::is('blog') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route("blog")}}">Bloglar</a>
                    </li>
                    <li class="nav-item
                     @if(Request::is("about") || Request::is("team") || Request::is("testimonials") || Request::is("faq") || Request::is("terms"))
                        active
                     @endif
                     dropdown">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Hakkımızda</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route("about")}}">Hakkımızda</a>
                            <a class="dropdown-item" href="{{route("team")}}">Takım</a>
                            <a class="dropdown-item" href="{{route("testimonials")}}">Görüşler</a>
                            <a class="dropdown-item" href="{{route("faq")}}">SSS</a>
                            <a class="dropdown-item" href="{{route("terms")}}">Şartlar</a>
                        </div>
                    </li>
                    <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route("contact")}}">Bize Ulaşın</a>
                    </li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item dropdown {{ Request::is('myProfile') ? 'active' : '' }}">
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route("myProfile")}}">Profil</a>
                                    <a class="dropdown-item" href="{{route("inbox")}}">Gelen Kutusu</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Çıkış Yap</a>
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{route("login")}}">Giriş Yap</a>
                            </li>
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>

@yield("content")

<!-- Footer Starts Here -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3 footer-item">
                <h4>AutoHeaven</h4>
                <p>En iyi fiyatlarla güvenilir araçlar sunuyoruz. Kalite ve müşteri memnuniyeti garantisi ile hizmetinizdeyiz.</p>
                <ul class="social-icons">
                    <li><a rel="nofollow" href="https://facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://x.com/"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
            <div class="col-md-3 footer-item">
                <h4>Kullanışlı Bağlantılar</h4>
                <ul class="menu-list">
                    <li><a href="{{route("index")}}">Ana Sayfa</a></li>
                    <li><a href="{{route("cars")}}">Arabalar</a></li>
                    <li><a href="{{route("contact")}}">Bize Ulaşın</a></li>
                    <li><a href="{{route("login")}}">Giriş Yap</a></li>
                    <li><a href="{{route("myProfile")}}">Profil</a></li>
                </ul>
            </div>
            <div class="col-md-3 footer-item">
                <h4>Ek Sayfalar</h4>
                <ul class="menu-list">
                    <li><a href="{{route("about")}}">Hakkımızda</a></li>
                    <li><a href="{{route("blog")}}">Blog</a></li>
                    <li><a href="{{route("faq")}}">SSS</a></li>
                    <li><a href="{{route("team")}}">Takım</a></li>
                    <li><a href="{{route("terms")}}">Şartlar</a></li>
                </ul>
            </div>
            <div class="col-md-3 footer-item last-item">
                <h4>Bize Ulaşın</h4>
                <div class="contact-form">
                    <form id="contact footer-contact" action="{{route("sendMessage")}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <fieldset>
                                    <input name="name_surname" type="text" class="form-control" id="name_surname" placeholder="Ad Soyad" autocomplete="off">
                                </fieldset>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <fieldset>
                                    <input name="email" type="text" class="form-control" id="email" pattern="[^ @]*@[^ @]*" placeholder="E-Posta" autocomplete="off">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <textarea name="message" rows="6" class="form-control" id="message" placeholder="Mesajınız"></textarea>
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
</footer>

<div class="sub-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Telif Hakkı © 2025 AutoHeaven</p>
            </div>
        </div>
    </div>
</div><div id="chat-circle" class="btn btn-raised">
    <div id="chat-overlay"></div>
    <i class="fa fa-comments" style="font-size: 24px; color: white;"></i>
</div>

<!-- Bootstrap core JavaScript -->
<script src="{{asset("vendor/jquery/jquery.min.js")}}"></script>
<script src="{{asset("vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<!-- Additional Scripts -->
<script src="{{asset("assets/js/custom.js")}}"></script>
<script src="{{asset("assets/js/owl.js")}}"></script>
<script src="{{asset("assets/js/slick.js")}}"></script>
<script src="{{asset("assets/js/accordions.js")}}"></script>

<script language = "text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
    function clearField(t){                   //declaring the array outside of the
        if(! cleared[t.id]){                      // function makes it static and global
            cleared[t.id] = 1;  // you could use true and false, but that's more typing
            t.value='';         // with more chance of typos
            t.style.color='#fff';
        }
    }
</script>

<!-- Chatbot HTML -->
<div class="chat-box">
    <div class="chat-box-header">
        <span>AutoHeaven Asistan</span>
        <span class="chat-box-toggle" onclick="closeChatBot()"><i class="fa fa-times"></i></span>
    </div>
    <div class="chat-box-body">
        <div class="chat-logs">
            <div class="chat-msg bot">
                <div class="cm-msg-text">
                    Merhaba! Ben AutoHeaven yapay zeka asistanı. Size uygun aracı bulmamı ister misiniz?
                </div>
            </div>
        </div>
    </div>
    <div class="chat-input">
        <form id="chat-submit-form">
            <input type="text" id="chat-input" placeholder="Aradığınız aracın özelliklerini yazın..."/>
            <button type="submit" class="chat-submit" id="chat-submit">
                <i class="fa fa-paper-plane"></i>
            </button>
        </form>
    </div>
</div>

<div id="chat-circle" onclick="openChatBot()" style="position: fixed; bottom: 50px; right: 50px; background: linear-gradient(135deg, #8ec63f 0%, #7ab92d 100%); width: 65px; height: 65px; border-radius: 50%; color: white; cursor: pointer; box-shadow: 0px 4px 20px rgba(142, 198, 63, 0.4), 0 2px 10px rgba(0, 0, 0, 0.2); z-index: 1000; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; animation: pulse 2s infinite;">
    <i class="fa fa-comments" style="font-size: 28px; color: white; filter: drop-shadow(0 1px 2px rgba(0,0,0,0.3));"></i>
</div>

<style>
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

#chat-circle:hover {
    transform: scale(1.1);
    box-shadow: 0px 6px 25px rgba(142, 198, 63, 0.6), 0 4px 15px rgba(0, 0, 0, 0.3);
}
</style>

<script>
// Chatbot functions
function openChatBot() {
    $("#chat-circle").fadeOut(200, function() {
        $(".chat-box").fadeIn(300).addClass('chat-box-active');
    });
}

function closeChatBot() {
    $(".chat-box").fadeOut(200, function() {
        $("#chat-circle").fadeIn(300);
        $(".chat-box").removeClass('chat-box-active');
    });
}

$(function() {
    console.log("Chatbot JavaScript yüklendi");

    $("#chat-circle").click(function(e) {
        e.preventDefault();
        openChatBot();
    });

    $(".chat-box-toggle").click(function(e) {
        e.preventDefault();
        closeChatBot();
    });

    // ESC tuşu ile kapat
    $(document).keyup(function(e) {
        if (e.keyCode === 27 && $(".chat-box").is(":visible")) {
            closeChatBot();
        }
    });


    $("#chat-submit-form").submit(function(e) {
        e.preventDefault(); 
        var msg = $("#chat-input").val();
        
        if(msg.trim() == '') {
            return false;
        }

        var userMsgHtml = '<div class="chat-msg user"><div class="cm-msg-text">' + msg + '</div></div>';
        $(".chat-logs").append(userMsgHtml);
        
        // Backend'e AJAX isteği gönder
        $.ajax({
            url: '/api/chatbot/ask',
            type: 'POST',
            data: { 
                message: msg,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log("Chatbot yanıtı:", response);
                
                var botMsgHtml = '<div class="chat-msg bot"><div class="cm-msg-text">';
                
                // Bot mesajını ekle
                if (response.message) {
                    botMsgHtml += response.message + '<br><br>';
                }
                
                if (response.success && response.cars && response.cars.length > 0) {
                    botMsgHtml += 'Sizin için şu araçları buldum:<br><br>';
                    response.cars.forEach(function(car) {
                        botMsgHtml += '🚗 <b><a href="' + car.link + '" target="_blank" style="color: #8ec63f; text-decoration: none;">' + (car.brand_name || 'Bilinmiyor') + ' ' + (car.model_name || 'Model') + '</a></b><br>';
                        botMsgHtml += '📅 Yıl: ' + (car.year || 'Bilinmiyor') + '<br>';
                        botMsgHtml += '💰 Fiyat: ' + (car.price ? car.price.toLocaleString('tr-TR') + ' TL' : 'N/A') + '<br>';
                        botMsgHtml += '🛣️ Km: ' + (car.km ? car.km.toLocaleString('tr-TR') : 'Bilinmiyor') + '<br>';
                        botMsgHtml += '🎨 Renk: ' + (car.color || 'Bilinmiyor') + '<br>';
                        botMsgHtml += '⚙️ Vites: ' + (car.gear_type || 'Bilinmiyor') + '<br>';
                        botMsgHtml += '⛽ Yakıt: ' + (car.fuel_type || 'Bilinmiyor') + '<br>';
                        botMsgHtml += '🛡️ Garanti: ' + (car.guarantee || 'Bilinmiyor') + '<br>';
                        botMsgHtml += '<hr style="margin:5px 0; border:0; border-top:1px solid #ddd;">';
                    });
                        botMsgHtml += 'ℹ️ Daha detaylı bilgi için araç isimlerine tıklayarak araç sayfalarına gidebilirsiniz.';
                            
                } else if (response.success && response.message && (!response.cars || response.cars.length === 0)) {
                    const shouldShowCars = response.show_cars;
                    const debugSaysHide = response.debug && response.debug.show_cars === false;

                    // Merhaba/Nasılsın gibi sohbet mesajlarında araç bulunamadı uyarısı göstermeyelim
                    if (shouldShowCars === false || debugSaysHide) {
                        // No-op
                    } else if (response.message.includes('Merhaba') || response.message.includes('hoşgeldiniz')) {
                        // Merhaba için ekstra mesaj gösterme
                    } else {
                        botMsgHtml += 'Üzgünüm, kriterlerinize uygun araç bulunamadı. Daha geniş arama yapmak ister misiniz?';
                    }
                } else {
                    botMsgHtml += 'Üzgünüm, söylediğinizi anlayamadım. Lütfen tekrar deneyin.';
                }
                
                botMsgHtml += '</div></div>';
                $(".chat-logs").append(botMsgHtml);
                
                $(".chat-box-body").animate({ scrollTop: $(".chat-box-body")[0].scrollHeight}, 1000);
            },
            error: function(xhr, status, error) {
                console.error("Chatbot hatası:", error);
                var errorMsgHtml = '<div class="chat-msg bot"><div class="cm-msg-text">Üzgünüm, şu anda teknik bir sorun yaşıyorum.</div></div>';
                $(".chat-logs").append(errorMsgHtml);
                $(".chat-box-body").animate({ scrollTop: $(".chat-box-body")[0].scrollHeight}, 1000);
            }
        });
        
        $("#chat-input").val(''); 
        
        $(".chat-box-body").animate({ scrollTop: $(".chat-box-body")[0].scrollHeight}, 1000);
        
        console.log("Mesaj başarıyla arayüze eklendi: " + msg);
    });
});
</script>

<script src="https://kit.fontawesome.com/e562692f21.js" crossorigin="anonymous"></script>

</body>
</html>
