<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'key' => 'lock application',
            'value' => '0',
            'tipe' => 'checkbox',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
