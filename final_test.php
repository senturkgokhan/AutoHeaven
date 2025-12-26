<?php

require_once 'vendor/autoload.php';

use Illuminate\Http\Request;
use App\Http\Controllers\ChatbotController;

// Laravel app başlat
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Test isteği oluştur
$testMessage = 'Bana 200000 tl altı araçları listeler misin';

// Laravel Request kontrol et
$request = Request::create('/test', 'POST', ['message' => $testMessage]);

echo "Test mesajı: '$testMessage'\n";
echo "Request mesajı: '" . $request->input('message') . "'\n\n";

// Controller'ı çalıştır
$controller = new ChatbotController();
$response = $controller->ask($request);

// Sonucu göster
$data = $response->getData();
echo "Bot yanıtı: " . $data->message . "\n";
echo "Filtreler: " . json_encode($data->filters) . "\n";
echo "Araç sayısı: " . count($data->cars) . "\n\n";

if (count($data->cars) > 0) {
    echo "Araç listesi:\n";
    foreach ($data->cars as $car) {
        echo "- " . $car->title . ": " . $car->price . " TL (Km: " . $car->km . ")\n";
    }
}