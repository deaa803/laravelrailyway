<?php

namespace Database\Seeders;

use App\Models\animal;
use Illuminate\Database\Seeder;

class animals extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        animal::create([
            'id'=>2,
            'name'=>'cat midi',
            'age'=>2
        ]);animal::create([
            'name'=>'dog hamza',
            'age'=>2
        ]);animal::create([
            'name'=>'beard ammar',
            'age'=>2
        ]);
    }
}
