<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function ask(Request $request)
    {
    // Mesaj alımı (JSON veya Form Data)
    $message = $request->input('message');
    if(!$message) {
        $data = json_decode($request->getContent(), true);
        $message = $data['message'] ?? null;
    }

    // Debug için log
    \Log::info('Chatbot Request Debug', [
        'all_input' => $request->all(),
        'content' => $request->getContent(),
        'message' => $message
    ]);

    if (!$message) {
        return response()->json(['success' => false, 'message' => 'Mesaj bulunamadı.']);
    }

    try {
            $filters = [];
            $botMessage = '';
            $showCars = false; 

            // Basit doğal dil işleme - mesajdan filtre çıkar
            $lowerMessage = strtolower($message);
            $normalizedMessage = preg_replace('/\s+/', ' ', $lowerMessage); // Çoklu boşlukları tek boşluğa çevir

            // Selamlama mesajları
            if (strpos($lowerMessage, 'merhaba') !== false || strpos($lowerMessage, 'selam') !== false || strpos($lowerMessage, 'hi') !== false) {
                $botMessage = 'Merhaba! AutoHeaven\'a hoşgeldiniz. Size uygun aracı bulmama yardımcı olabilirim. Ne tür bir araç arıyorsunuz?';
                $showCars = false; // Merhaba için araç gösterme
            }
            // Genel sohbet mesajları
            elseif (strpos($lowerMessage, 'nasılsın') !== false || strpos($lowerMessage, 'nasilsin') !== false) {
                $botMessage = 'Ben çok iyiyim, teşekkürler! Size araç konusunda yardımcı olmaya hazırım. Ne tür bir araç arıyorsunuz?';
                $showCars = false;
            }
            elseif (strpos($lowerMessage, 'iyiyim') !== false || strpos($lowerMessage, 'iyiyiz') !== false || preg_match('/\biyi\b/u', $lowerMessage)) {
                $botMessage = 'Harika! Size uygun araçlar bulmama yardımcı olabilirim. Ne arıyorsunuz?';
                $showCars = false;
            }
            elseif (strpos($lowerMessage, 'teşekkür') !== false || strpos($lowerMessage, 'sağ ol') !== false || strpos($lowerMessage, 'sağol') !== false) {
                $botMessage = 'Rica ederim! Başka bir konuda yardıma ihtiyacınız var mı?';
                $showCars = false;
            }
            elseif (strpos($lowerMessage, 'görüşürüz') !== false || strpos($lowerMessage, 'görüşmek') !== false || strpos($lowerMessage, 'bye') !== false || strpos($lowerMessage, 'hoşça kal') !== false) {
                $botMessage = 'Görüşmek üzere! AutoHeaven\'ı tercih ettiğiniz için teşekkürler.';
                $showCars = false;
            }
            elseif (strpos($lowerMessage, 'yardım') !== false || strpos($lowerMessage, 'help') !== false) {
                $botMessage = 'Size nasıl yardımcı olabilirim? Araç arama konusunda fiyat, marka, model, vites tipi, yakıt tipi gibi kriterlerle arama yapabilirim.';
                $showCars = false;
            }
            //Fiyat filtresi
            elseif (preg_match('/(\d+(?:,\d{3})*(?:\.\d+)?)\s*(bin|000|k|tl|TL)/i', $lowerMessage, $matches) ||
                    preg_match('/(\d+)\s*(bin|000|k|tl|TL)/i', $lowerMessage, $matches)) {
                $priceStr = str_replace(',', '', $matches[1]); // Virgülleri kaldır
                $price = (int)$priceStr;

                if (strpos($lowerMessage, 'bin') !== false || strpos($lowerMessage, 'k') !== false) {
                    $price *= 1000;
                }

                $filters['max_price'] = $price;

                if ($price < 100000) {
                    $botMessage = 'Çok uygun fiyat! ' . number_format($price) . ' TL ve altı araçları arıyorum...';
                } elseif ($price < 200000) {
                    $botMessage = number_format($price) . ' TL ve altı ekonomik araçları buluyorum...';
                } elseif ($price < 300000) {
                    $botMessage = number_format($price) . ' TL ve altı orta segment araçları arıyorum...';
                } else {
                    $botMessage = number_format($price) . ' TL ve altı kaliteli araçları gösteriyorum...';
                }
                $showCars = true;
            }
            // Vites tipi
            elseif (strpos($lowerMessage, 'yarı otomatik') !== false || strpos($lowerMessage, 'yarıotomatik') !== false) {
                $filters['gear_type'] = 'Yarı-Otomatik';
                $botMessage = 'Yarı otomatik vites araçları arıyorum...';
                $showCars = true;
            }
            elseif (strpos($lowerMessage, 'otomatik') !== false) {
                $filters['gear_type'] = 'Otomatik';
                $botMessage = 'Otomatik vites araçları arıyorum...';
                $showCars = true;
            }
            elseif (strpos($lowerMessage, 'manuel') !== false) {
                $filters['gear_type'] = 'Manuel';
                $botMessage = 'Manuel vites araçları arıyorum...';
                $showCars = true;
            }
            // Yakıt tipi
            elseif (strpos($lowerMessage, 'benzin') !== false) {
                $filters['fuel_type'] = 'Benzin';
                $botMessage = 'Benzinli araçları arıyorum...';
                $showCars = true;
            }
            elseif (strpos($lowerMessage, 'dizel') !== false || strpos($lowerMessage, 'diesel') !== false) {
                $filters['fuel_type'] = 'Dizel';
                $botMessage = 'Dizel araçları arıyorum...';
                $showCars = true;
            }
            // Genel arama terimleri
            elseif (strpos($lowerMessage, 'ucuz') !== false) {
                $filters['max_price'] = 150000;
                $botMessage = 'Ucuz ve ekonomik araçları buluyorum...';
                $showCars = true;
            }
            elseif (strpos($lowerMessage, 'pahalı') !== false || strpos($lowerMessage, 'lüks') !== false) {
                $filters['max_price'] = 350000;
                $botMessage = 'Kaliteli ve lüks araçları gösteriyorum...';
                $showCars = true;
            }
            elseif (strpos($lowerMessage, 'yeni') !== false) {
                $filters['max_price'] = 300000; // Daha yeni araçlar genellikle daha pahalı
                $botMessage = 'Yeni model araçları arıyorum...';
                $showCars = true;
            }
            elseif (strpos($lowerMessage, 'eski') !== false) {
                $filters['max_price'] = 120000;
                $botMessage = 'Klasik ve eski model araçları buluyorum...';
                $showCars = true;
            }
            // Km filtresi - daha esnek
            elseif (preg_match('/(\d+)\s*km\s*(altı|aşağı|az)/i', $normalizedMessage, $matches)) {
                $filters['max_km'] = (int)$matches[1];
                $botMessage = number_format($matches[1]) . ' km ve altı araçları arıyorum...';
                $showCars = true;
            }
            elseif (preg_match('/(\d+)\s*km\s*(üstü|yukarı|fazla|çok)/i', $normalizedMessage, $matches)) {
                $filters['min_km'] = (int)$matches[1];
                $botMessage = number_format($matches[1]) . ' km ve üstü araçları arıyorum...';
                $showCars = true;
            }
            elseif (preg_match('/(\d+)\s*km/i', $normalizedMessage, $matches)) {
                $km = (int)$matches[1];
                if ($km < 100000) {
                    $filters['max_km'] = $km;
                    $botMessage = number_format($km) . ' km ve altı araçları arıyorum...';
                } else {
                    $filters['min_km'] = $km;
                    $botMessage = number_format($km) . ' km ve üstü araçları arıyorum...';
                }
                $showCars = true;
            }
            // Yıl filtresi
            elseif (preg_match('/(\d{4})\s*(model|yaşında|yılı)/i', $lowerMessage, $matches)) {
                $year = (int)$matches[1];
                if ($year > 2000) {
                    $filters['min_year'] = $year;
                    $botMessage = $year . ' ve sonrası model araçları arıyorum...';
                } else {
                    $filters['max_year'] = $year;
                    $botMessage = $year . ' ve öncesi model araçları arıyorum...';
                }
                $showCars = true;
            }
            // Renk filtresi
            elseif (preg_match('/(beyaz|siyah|kırmızı|mavi|gri|gümüş|metalik|sarı|yeşil|turuncu)/i', $lowerMessage, $matches)) {
                $filters['color'] = $matches[1];
                $botMessage = ucfirst($matches[1]) . ' renk araçları arıyorum...';
                $showCars = true;
            }
            // Garanti filtresi
            elseif (strpos($lowerMessage, 'garantili') !== false) {
                $filters['guarantee'] = 1; // 1 = Garantili
                $botMessage = 'Garantili araçları arıyorum...';
                $showCars = true;
            }
            elseif (strpos($lowerMessage, 'garantisiz') !== false) {
                $filters['guarantee'] = 2; // 2 = Garantisiz
                $botMessage = 'Garantisiz araçları arıyorum...';
                $showCars = true;
            }
            else {
                $botMessage = '';
            }

            $apiKey = env('OPENAI_API_KEY');
            if ($apiKey) {
                $prompt = "Sen bir araç arama asistanısın. Kullanıcının mesajından araç filtrelerini çıkar ve sadece JSON formatında yanıt ver.

Kullanılabilir filtreler:
- max_price: maksimum fiyat (sayı olarak, TL cinsinden)
- min_price: minimum fiyat (sayı olarak, TL cinsinden)
- gear_type: \"Manuel\", \"Otomatik\", \"Yarı-Otomatik\"
- fuel_type: \"Benzin\", \"Dizel\", \"LPG\", \"Elektrik\"
- max_km: maksimum kilometre (sayı olarak)
- min_km: minimum kilometre (sayı olarak)
- min_year: minimum yıl (sayı olarak)
- max_year: maksimum yıl (sayı olarak)
- color: renk adı (string)
- guarantee: \"Garantili\" veya \"Garantisiz\"
Yanıt formatı: {\"max_price\": 200000, \"gear_type\": \"Otomatik\", \"fuel_type\": \"Benzin\"}

Kullanıcı mesajı: '" . $message . "'";

                try {
                    $response = Http::timeout(15)
                        ->withHeaders([
                            'Authorization' => 'Bearer ' . $apiKey,
                            'Content-Type' => 'application/json',
                        ])
                        ->post('https://api.openai.com/v1/chat/completions', [
                            'model' => 'gpt-3.5-turbo',
                            'messages' => [
                                [
                                    'role' => 'system',
                                    'content' => 'Sen bir araç arama asistanısın. Kullanıcı mesajlarından araç filtreleri çıkarıp JSON formatında döndürürsün.'
                                ],
                                [
                                    'role' => 'user',
                                    'content' => $prompt
                                ]
                            ],
                            'max_tokens' => 200,
                            'temperature' => 0.1
                        ]);

                    if ($response->successful()) {
                        $data = $response->json();
                        $rawText = $data['choices'][0]['message']['content'] ?? '{}';
                        $aiFilters = json_decode(trim($rawText), true);

                        if ($aiFilters && is_array($aiFilters)) {
                            $filters = array_merge($filters, $aiFilters);
                            $botMessage .= ' (AI ile analiz edildi)';
                        }
                    } else {
                        \Log::warning('OpenAI API başarısız: ' . $response->status() . ' - ' . $response->body());
                    }
                } catch (\Exception $e) {
                    \Log::error('OpenAI API hatası: ' . $e->getMessage());
                }
            }

            $data = $data ?? null;
            $rawText = $rawText ?? 'MANUAL_FILTERING';

            $query = Car::query();

        // Filtreleri Uygula
        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }
        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (!empty($filters['gear_type'])) {
            $gearMap = ["Manuel" => 1, "Otomatik" => 2, "Yarı-Otomatik" => 3];
            if(isset($gearMap[$filters['gear_type']])) {
                $query->where('gear_type', $gearMap[$filters['gear_type']]);
            }
        }

        if (!empty($filters['fuel_type'])) {
            $fuelMap = ["Benzin" => 1, "Dizel" => 2, "LPG" => 3, "Elektrik" => 4];
            if(isset($fuelMap[$filters['fuel_type']])) {
                $query->where('fuel_type', $fuelMap[$filters['fuel_type']]);
            }
        }

        if (!empty($filters['max_km'])) {
            $query->where('km', '<=', $filters['max_km']);
        }
        if (!empty($filters['min_km'])) {
            $query->where('km', '>=', $filters['min_km']);
        }

        if (!empty($filters['min_year'])) {
            $query->whereYear('year', '>=', $filters['min_year']);
        }
        if (!empty($filters['max_year'])) {
            $query->whereYear('year', '<=', $filters['max_year']);
        }

        if (!empty($filters['color'])) {
            $query->where('color', 'like', '%' . $filters['color'] . '%');
        }

        if (array_key_exists('guarantee', $filters) && $filters['guarantee'] !== null && $filters['guarantee'] !== '') {
            $query->where('guarantee', $filters['guarantee']);
        }

        $cars = $query->with(['getModels.getBrands'])->orderByRaw('RAND()')->take(5)->get();

        // Araçları formatla
        $formattedCars = $cars->map(function($car) {
            $gearTypes = [1 => 'Manuel', 2 => 'Otomatik', 3 => 'Yarı-Otomatik'];
            $fuelTypes = [1 => 'Benzin', 2 => 'Dizel', 3 => 'LPG', 4 => 'Elektrik'];
            $colorTypes = [" ", "Beyaz", "Siyah", "Gri", "Gümüş", "Mavi", "Kırmızı", "Diğer"];

            return [
                'id' => $car->id,
                'title' => $car->title,
                'link' => route('car-details', $car->id), //araç linklerine yollar
                'brand_name' => $car->getModels->getBrands->name ?? 'Bilinmiyor',
                'model_name' => $car->getModels->name ?? 'Bilinmiyor',
                'year' => $car->year,
                'price' => $car->price,
                'km' => $car->km,
                'color' => $colorTypes[$car->color] ?? 'Bilinmiyor',
                'gear_type' => $gearTypes[$car->gear_type] ?? 'Bilinmiyor',
                'fuel_type' => $fuelTypes[$car->fuel_type] ?? 'Bilinmiyor',
                'guarantee' => $car->guarantee == 1 ? 'Garantili' : 'Garantisiz'
            ];
        });

        return response()->json([
            'success' => true,
            'message' => $botMessage,
            'cars' => $showCars ? $formattedCars : [],
            'filters' => $filters,
            'show_cars' => $showCars,
            'debug' => [
                'message' => $message,
                'show_cars' => $showCars,
                'api_response' => $data ?? null,
                'raw_text' => $rawText ?? null,
                'total_cars_found' => $cars->count()
            ]
        ]);

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Bir hata oluştu: ' . $e->getMessage()]);
    }
}
}