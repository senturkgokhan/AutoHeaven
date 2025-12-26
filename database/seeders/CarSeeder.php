<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            ["user_id" => 1, "title" => "Hyundai i10", "description" => "Temiz kullanılmış sedan araç.", "model_id" => 45, 'year' => Carbon::createFromFormat('Y-m-d', '2015-06-15'), "color" => 5, "km" => 120000, "guarantee" => 1, "gear_type" => 2, "fuel_type" => 1, "damage_id" => 1, "price" => 150000, "media" => "car1.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 1, "title" => "Opel Astra", "description" => "Düşük km, yakıt tasarruflu hatchback.", "model_id" => 32, 'year' => Carbon::createFromFormat('Y-m-d', '2018-03-20'), "color" => 7, "km" => 90000, "guarantee" => 2, "gear_type" => 3, "fuel_type" => 2, "damage_id" => 2, "price" => 130000, "media" => "car2.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 2, "title" => "Peugeot Rifter", "description" => "Güçlü motor, off-road kullanıma uygun.", "model_id" => 78, 'year' => Carbon::createFromFormat('Y-m-d', '2016-08-05'), "color" => 7, "km" => 85000, "guarantee" => 1, "gear_type" => 1, "fuel_type" => 3, "damage_id" => 3, "price" => 220000, "media" => "car3.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 2, "title" => "Ford Fiesta", "description" => "Aile arabası, geniş bagaj hacmi.", "model_id" => 51, 'year' => Carbon::createFromFormat('Y-m-d', '2017-11-12'), "color" => 1, "km" => 67000, "guarantee" => 2, "gear_type" => 2, "fuel_type" => 1, "damage_id" => 4, "price" => 190000, "media" => "car4.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 3, "title" => "Fiat Egea", "description" => "Yüksek performans, spor araba.", "model_id" => 12, 'year' => Carbon::createFromFormat('Y-m-d', '2014-04-22'), "color" => 4, "km" => 45000, "guarantee" => 1, "gear_type" => 1, "fuel_type" => 1, "damage_id" => 5, "price" => 300000, "media" => "car5.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 3, "title" => "Opel Crossland", "description" => "Şehir içi kullanıma uygun, rahat.", "model_id" => 34, 'year' => Carbon::createFromFormat('Y-m-d', '2013-12-10'), "color" => 6, "km" => 150000, "guarantee" => 2, "gear_type" => 2, "fuel_type" => 1, "damage_id" => 6, "price" => 110000, "media" => "car6.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 4, "title" => "Honda ZR-V", "description" => "Aileler için geniş ve konforlu SUV.", "model_id" => 89, 'year' => Carbon::createFromFormat('Y-m-d', '2019-05-14'), "color" => 6, "km" => 50000, "guarantee" => 1, "gear_type" => 3, "fuel_type" => 2, "damage_id" => 7, "price" => 250000, "media" => "car7.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 4, "title" => "Volkswagen Passat", "description" => "Şehir içi kullanım için ideal hatchback.", "model_id" => 23, 'year' => Carbon::createFromFormat('Y-m-d', '2020-01-09'), "color" => 3, "km" => 30000, "guarantee" => 1, "gear_type" => 2, "fuel_type" => 1, "damage_id" => 8, "price" => 160000, "media" => "car8.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 5, "title" => "Ford Ranger", "description" => "Geniş aileler için ideal, temiz kullanılmış.", "model_id" => 55, 'year' => Carbon::createFromFormat('Y-m-d', '2013-07-18'), "color" => 5, "km" => 210000, "guarantee" => 2, "gear_type" => 2, "fuel_type" => 3, "damage_id" => 9, "price" => 140000, "media" => "car9.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 5, "title" => "Toyota Avensis", "description" => "Spor ve dinamik tasarıma sahip coupe.", "model_id" => 66, 'year' => Carbon::createFromFormat('Y-m-d', '2018-02-27'), "color" => 4, "km" => 65000, "guarantee" => 1, "gear_type" => 1, "fuel_type" => 1, "damage_id" => 10, "price" => 280000, "media" => "car10.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 6, "title" => "Fiat 500L", "description" => "Az yakıt tüketen, düşük km.", "model_id" => 18, 'year' => Carbon::createFromFormat('Y-m-d', '2019-09-30'), "color" => 7, "km" => 40000, "guarantee" => 1, "gear_type" => 2, "fuel_type" => 2, "damage_id" => 11, "price" => 170000, "media" => "car11.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 6, "title" => "Opel Meriva", "description" => "Konforlu, geniş bagaj hacmi.", "model_id" => 40, 'year' => Carbon::createFromFormat('Y-m-d', '2017-05-22'), "color" => 3, "km" => 72000, "guarantee" => 2, "gear_type" => 3, "fuel_type" => 1, "damage_id" => 12, "price" => 145000, "media" => "car12.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 7, "title" => "Volvo XC60", "description" => "Off-road performansı yüksek SUV.", "model_id" => 92, 'year' => Carbon::createFromFormat('Y-m-d', '2016-06-07'), "color" => 2, "km" => 99000, "guarantee" => 1, "gear_type" => 1, "fuel_type" => 3, "damage_id" => 13, "price" => 230000, "media" => "car13.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 7, "title" => "Ford Tourneo", "description" => "Güçlü motorlu, arazi şartlarına uygun.", "model_id" => 57, 'year' => Carbon::createFromFormat('Y-m-d', '2020-04-16'), "color" => 3, "km" => 45000, "guarantee" => 2, "gear_type" => 2, "fuel_type" => 2, "damage_id" => 14, "price" => 210000, "media" => "car14.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 8, "title" => "Volkswagen Beetle", "description" => "Şehir içi kullanıma uygun, ekonomik.", "model_id" => 30, 'year' => Carbon::createFromFormat('Y-m-d', '2015-10-19'), "color" => 2, "km" => 105000, "guarantee" => 1, "gear_type" => 3, "fuel_type" => 1, "damage_id" => 15, "price" => 125000, "media" => "car15.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 8, "title" => "Peugeot 5008", "description" => "Yaz günleri için ideal, üstü açılır.", "model_id" => 77, 'year' => Carbon::createFromFormat('Y-m-d', '2021-07-03'), "color" => 5, "km" => 20000, "guarantee" => 2, "gear_type" => 1, "fuel_type" => 1, "damage_id" => 16, "price" => 350000, "media" => "car16.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 9, "title" => "Honda HR-V", "description" => "Geniş ve konforlu, aile için uygun.", "model_id" => 83, 'year' => Carbon::createFromFormat('Y-m-d', '2018-11-11'), "color" => 2, "km" => 74000, "guarantee" => 1, "gear_type" => 2, "fuel_type" => 3, "damage_id" => 17, "price" => 240000, "media" => "car17.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 9, "title" => "Volkswagen T-Roc", "description" => "Düşük km, sorunsuz kullanım.", "model_id" => 29, 'year' => Carbon::createFromFormat('Y-m-d', '2014-02-15'), "color" => 5, "km" => 92000, "guarantee" => 1, "gear_type" => 1, "fuel_type" => 1, "damage_id" => 18, "price" => 130000, "media" => "car18.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 10, "title" => "Hyundai Elantra", "description" => "Şehir içi için ekonomik ve pratik.", "model_id" => 41, 'year' => Carbon::createFromFormat('Y-m-d', '2016-12-25'), "color" => 6, "km" => 60000, "guarantee" => 2, "gear_type" => 2, "fuel_type" => 2, "damage_id" => 19, "price" => 155000, "media" => "car19.jpg", "created_at" => now(), "updated_at" => now()],
            ["user_id" => 10, "title" => "Toyota C-HR", "description" => "Spor ve şık tasarımlı coupe.", "model_id" => 63, 'year' => Carbon::createFromFormat('Y-m-d', '2019-08-22'), "color" => 7, "km" => 33000, "guarantee" => 1, "gear_type" => 3, "fuel_type" => 1, "damage_id" => 20, "price" => 310000, "media" => "car20.jpg", "created_at" => now(), "updated_at" => now()],
        ];

        DB::table('cars')->insert($cars);
    }
}
