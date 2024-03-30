<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Title;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Title::create([
        'tit_name' => 'นาย',
        'tit_order' => 4
        ]);
        Title::create([
        'tit_name' => 'นางสาว',
        'tit_order' => 2
        ]);
        Title::create([
        'tit_name' => 'นาง',
        'tit_order' => 3
        ]);
        Title::create([
        'tit_name' => 'คุณ',
        'tit_order' => 1
        ]);
    }
}
