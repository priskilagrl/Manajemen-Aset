<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['name' => 'Baik', 'description' => 'Aset dalam Kondisi Baik']);
        Status::create(['name' => 'Rusak', 'description' => 'Aset dalam Kondisi Rusak']);
        Status::create(['name' => 'Dalam Perbaikan', 'description' => 'Aset Dalam Perbaikan']);
    }
}
