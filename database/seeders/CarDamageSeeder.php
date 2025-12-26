<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CarDamageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carDamages = [
            ["description" => "Kaput üzerinde hafif çizikler mevcut.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Arka tamponda küçük bir göçük var.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Sol arka kapı değişmiş, boya farkı var.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Ön cam çatlak, değişmesi gerekiyor.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Yan aynada küçük çizikler mevcut.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Arka sağ çamurluk hafif darbeli.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Tavan üzerinde hafif boya dökülmesi var.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Ön tamponda sürtünme izleri var.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Kapı kollarında hafif çizikler mevcut.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Sağ far değişmiş, boya farkı var.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Arka kapı camı değişmiş, camda küçük izler var.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Motor kapağında hafif ezik mevcut.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Sağ ön kapıda derin çizik var.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Arka tamponda boya dökülmesi mevcut.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Ön çamurluk değişmiş, boya farkı var.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Sol arka far kırık, değişmesi gerekiyor.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Kaput üzerinde derin çizik var.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Bagaj kapağında hafif ezik mevcut.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Ön sol kapıda sürtünme izi var.", "created_at" => now(), "updated_at" => now()],
            ["description" => "Arka cam çatlamış, değişmesi gerekiyor.", "created_at" => now(), "updated_at" => now()],
        ];

        DB::table('car_damages')->insert($carDamages);
    }
}
