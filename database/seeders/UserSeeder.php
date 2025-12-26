<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ["name" => "Ali", "surname" => "Yılmaz", "role" => 1, "email" => "ali.yilmaz@example.com", "phone" => "05551234567", "password" => Hash::make('password_hash1'), "job" => "Yazılım Mühendisi", "bio" => "Kıdemli yazılım mühendisi.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Ayşe", "surname" => "Kaya", "role" => 1, "email" => "ayse.kaya@example.com", "phone" => "05551234568", "password" => Hash::make('password_hash2'), "job" => "Grafik Tasarımcı", "bio" => "Yaratıcı grafik tasarımcı.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Mehmet", "surname" => "Demir", "role" => 1, "email" => "mehmet.demir@example.com", "phone" => "05551234569", "password" => Hash::make('password_hash3'), "job" => "Proje Yöneticisi", "bio" => "Deneyimli proje yöneticisi.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Fatma", "surname" => "Çelik", "role" => 1, "email" => "fatma.celik@example.com", "phone" => "05551234570", "password" => Hash::make('password_hash4'), "job" => "Veri Analisti", "bio" => "Veri analizi konusunda uzman.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Ahmet", "surname" => "Şahin", "role" => 1, "email" => "ahmet.sahin@example.com", "phone" => "05551234571", "password" => Hash::make('password_hash5'), "job" => "Sistem Yöneticisi", "bio" => "Bilgi teknolojileri sistem yöneticisi.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Emine", "surname" => "Arslan", "role" => 1, "email" => "emine.arslan@example.com", "phone" => "05551234572", "password" => Hash::make('password_hash6'), "job" => "İçerik Yöneticisi", "bio" => "Dijital içerik yönetimi konusunda uzman.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Mustafa", "surname" => "Eren", "role" => 1, "email" => "mustafa.eren@example.com", "phone" => "05551234573", "password" => Hash::make('password_hash7'), "job" => "Mobil Uygulama Geliştirici", "bio" => "Mobil uygulama geliştirme uzmanı.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Zeynep", "surname" => "Öztürk", "role" => 1, "email" => "zeynep.ozturk@example.com", "phone" => "05551234574", "password" => Hash::make('password_hash8'), "job" => "UI/UX Tasarımcı", "bio" => "Kullanıcı deneyimi ve arayüz tasarımında uzman.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Hasan", "surname" => "Koç", "role" => 1, "email" => "hasan.koc@example.com", "phone" => "05551234575", "password" => Hash::make('password_hash9'), "job" => "Veritabanı Yöneticisi", "bio" => "Veritabanı yönetiminde tecrübeli.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Hatice", "surname" => "Bozkurt", "role" => 1, "email" => "hatice.bozkurt@example.com", "phone" => "05551234576", "password" => Hash::make('password_hash10'), "job" => "İş Zekası Uzmanı", "bio" => "İş zekası çözümleri geliştirme.", "created_at" => now(), "updated_at" => now()],
        ];

        DB::table('users')->insert($users);
    }
}
