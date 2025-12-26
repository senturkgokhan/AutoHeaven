<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        @livewireScripts

        <div id="chat-circle" onclick="openChatBot()" style="position: fixed; bottom: 30px; right: 30px; background: #8ec63f; width: 65px; height: 65px; border-radius: 50%; color: white; text-align: center; line-height: 65px; cursor: pointer; z-index: 999999 !important; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
            <i class="fa fa-comments" style="font-size: 28px;"></i>
        </div>

        <div id="main-chat-box" style="display: none; position: fixed; right: 30px; bottom: 110px; width: 350px; height: 450px; background: white; border-radius: 15px; box-shadow: 0 5px 30px rgba(0,0,0,0.3); z-index: 999999 !important; flex-direction: column; border: 1px solid #ddd;">
            <div style="background: #8ec63f; color: white; padding: 15px; border-radius: 15px 15px 0 0; display: flex; justify-content: space-between; align-items: center;">
                <span style="font-weight: bold;">AutoHeaven Asistan</span>
                <span onclick="closeChatBot()" style="cursor: pointer; font-size: 20px; font-weight: bold;">&times;</span>
            </div>
            <div id="chat-body" style="flex: 1; overflow-y: auto; padding: 15px; background: #f9f9f9;">
                <div id="chat-logs-container">
                    <div style="margin-bottom: 10px;"><span style="background:#eee; padding:8px; border-radius:10px; display:inline-block;">Merhaba! Size nasıl yardımcı olabilirim?</span></div>
                </div>
            </div>
            <div style="padding: 10px; border-top: 1px solid #eee; background: white; border-radius: 0 0 15px 15px;">
                <form onsubmit="event.preventDefault(); handleChatSubmit();">
                    <input type="text" id="chat-input-field" placeholder="Bir şeyler yazın..." style="width: 80%; border: none; outline: none; padding: 5px;">
                    <button type="submit" style="background: none; border: none; color: #8ec63f; cursor: pointer; font-weight: bold;">Gönder</button>
                </form>
            </div>
        </div>

        <script>
        function openChatBot() {
            document.getElementById('main-chat-box').style.display = 'flex';
            document.getElementById('chat-circle').style.display = 'none';
        }

        function closeChatBot() {
            document.getElementById('main-chat-box').style.display = 'none';
            document.getElementById('chat-circle').style.display = 'block';
        }

        async function handleChatSubmit() {
            console.log("handleChatSubmit fonksiyonu çağrıldı");
            
            const inputField = document.getElementById('chat-input-field');
            const logsContainer = document.getElementById('chat-logs-container');
            const chatBody = document.getElementById('chat-body');
            const message = inputField.value.trim();

            console.log("Mesaj:", message);

            if (!message) {
                console.log("Mesaj boş, fonksiyondan çıkılıyor");
                return;
            }

            // 1. Kullanıcı mesajını ekrana ekle
            logsContainer.innerHTML += `<div style="text-align:right; margin-bottom:10px;"><span style="background:#8ec63f; color:white; padding:8px 12px; border-radius:15px; display:inline-block; max-width:80%;">${message}</span></div>`;
            inputField.value = "";
            chatBody.scrollTop = chatBody.scrollHeight;

            // 2. Yükleniyor durumunu ekle
            const loaderId = "loader_" + Date.now();
            logsContainer.innerHTML += `<div id="${loaderId}" style="margin-bottom: 10px;"><span style="color:#777; font-size:13px; font-style:italic;">Düşünüyorum...</span></div>`;
            chatBody.scrollTop = chatBody.scrollHeight;

            try {
                console.log("Chatbot isteği gönderiliyor:", message);
                console.log("API URL:", "/api/chatbot/ask");
                
                // 3. Backend'e Fetch ile istek at (API route kullanarak CSRF sorununu önlüyoruz)
                const response = await fetch("/api/chatbot/ask", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ message: message })
                });

                console.log("Chatbot yanıtı alındı:", response.status);
                console.log("Response headers:", response.headers);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                console.log("Response data:", data);
                
                // Yükleniyor'u kaldır
                const loader = document.getElementById(loaderId);
                if(loader) loader.remove();

                // 4. Bot cevabını işle
                let botHtml = "Uygun araç bulunamadı.";
                if (data.success && data.cars && data.cars.length > 0) {
                    botHtml = "Sizin için şu araçları buldum:<br><br>";
                    data.cars.forEach(car => {
                        botHtml += `🚗 <b>${car.title}</b><br>💰 Fiyat: ${car.price} TL<hr style="margin:5px 0; border:0; border-top:1px solid #ddd;">`;
                    });
                } else if (data.filters) {
                     botHtml = "Kriterlerinize uygun araç şu an stoklarımızda yok.";
                }

                logsContainer.innerHTML += `<div style="margin-bottom:10px;"><span style="background:#eee; color:#333; padding:10px; border-radius:15px; display:inline-block; max-width:85%; font-size:14px;">${botHtml}</span></div>`;
                chatBody.scrollTop = chatBody.scrollHeight;

            } catch (error) {
                console.error("Hata:", error);
                const loader = document.getElementById(loaderId);
                if(loader) loader.innerHTML = `<span style="color:red; font-size:12px;">Bağlantı hatası oluştu.</span>`;
            }
        }
        </script>
    </body>
</html>