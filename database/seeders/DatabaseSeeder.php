<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // استدعاء الـ Seeders الأخرى هنا
        $this->call([
            UserSeeder::class,
            // أضف باقي الـ Seeders هنا
        ]);
    }
}