<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            ["name_surname" => "Ali Yılmaz", "email" => "ali.yilmaz@example.com", "topic" => "Araç teslimatında gecikme", "message" => "Satın aldığım aracın teslimatı beklenenden 2 hafta geç yapıldı. Daha hızlı bir teslimat süreci beklerdim.", "created_at" => now(), "updated_at" => now()],
            ["name_surname" => "Ayşe Kaya", "email" => "ayse.kaya@example.com", "topic" => "Servis hizmeti", "message" => "Aracımı satın aldıktan sonra serviste bazı yedek parçaların tedarik edilmesi çok uzun sürdü. Bu konuda gelişme olmalı.", "created_at" => now(), "updated_at" => now()],
            ["name_surname" => "Mehmet Demir", "email" => "mehmet.demir@example.com", "topic" => "İkinci El Yardımı", "message" => "Aldığım ikinci el aracın garanti kapsamı hakkında daha net bilgi verilmesini isterdim. Şu anda birçok konuda belirsizlik var.", "created_at" => now(), "updated_at" => now()],
            ["name_surname" => "Fatma Çelik", "email" => "fatma.celik@example.com", "topic" => "Aksesuar Yetersizliği", "message" => "Aracımla birlikte sunulan aksesuarların çeşitliliği yetersizdi. Özellikle kış lastikleri dahil edilse daha iyi olurdu.", "created_at" => now(), "updated_at" => now()],
            ["name_surname" => "Ahmet Şahin", "email" => "ahmet.sahin@example.com", "topic" => "Test Sürüşü", "message" => "Yeni model araçlar için test sürüşü yapma imkanının daha kolay sağlanmasını istiyorum.", "created_at" => now(), "updated_at" => now()],
            ["name_surname" => "Emine Arslan", "email" => "emine.arslan@example.com", "topic" => "Fiyatlandırma", "message" => "Aracın fiyatı, diğer bayilerle kıyaslandığında biraz daha yüksekti. Fiyat konusunda daha rekabetçi olunması gerektiğini düşünüyorum.", "created_at" => now(), "updated_at" => now()],
            ["name_surname" => "Mustafa Eren", "email" => "mustafa.eren@example.com", "topic" => "Satış sonrası destek", "message" => "Aracı aldıktan sonra satış sonrası destek ekibiyle iletişime geçmek zor oldu. Destek süreci daha hızlı olmalı.", "created_at" => now(), "updated_at" => now()],
            ["name_surname" => "Zeynep Öztürk", "email" => "zeynep.ozturk@example.com", "topic" => "Araba renk seçenekleri", "message" => "İstediğim renk seçeneği stokta yoktu. Daha geniş bir renk yelpazesi sunulması gerektiğini düşünüyorum.", "created_at" => now(), "updated_at" => now()],
            ["name_surname" => "Hasan Koç", "email" => "hasan.koc@example.com", "topic" => "Yakıt verimliliği", "message" => "Aracın yakıt tüketimi katalogda belirtilen değerlere göre daha yüksek. Bu konuda bilgilendirme daha şeffaf olmalı.", "created_at" => now(), "updated_at" => now()],
            ["name_surname" => "Hatice Bozkurt", "email" => "hatice.bozkurt@example.com", "topic" => "Online satış süreci", "message" => "Online araç satış sürecinde bazı teknik aksaklıklar yaşadım ve işlemlerimi tamamlamakta zorlandım. Bu konuda iyileştirme yapılmalı.", "created_at" => now(), "updated_at" => now()],
        ];

        DB::table('contacts')->insert($contacts);
    }
}
