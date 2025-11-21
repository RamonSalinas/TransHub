<?php
// filepath: /home/adrian/Documentos/transufob/database/seeders/AtrasoSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Atraso;



class DatabaseSeeder extends Seeder

{
    public function run(): void
    {
        $this->call([
            AtrasoSeeder::class,
        ]);
    }
}