<?php

namespace Database\Seeders;

use App\Models\Prestaties;
use App\Models\Oefening;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OefeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Oefening')->insert([
            'Naam' => Str('Planken'),
            'Beschrijving' => Str('Rugspieren trainen'),
            'Stappen' => Str('1. Lig met je buik op de grond. 2. Til jezelf op met je voorarmen. 3. Blijf dit aanhouden totdat je niet meer kan.'),
        ]);
        DB::table('Oefening')->insert([
            'Naam' => Str('Squaten'),
            'Beschrijving' => Str('Benen trainen'),
            'Stappen' => Str('1. Ga recht op staan . 2. Ga in een hurk vorm met een rechte rug. 3. Ga hier na weer omhoog.'),
        ]);
        DB::table('Oefening')->insert([
            'Naam' => Str('Dips'),
            'Beschrijving' => Str('armen trainen'),
            'Stappen' => Str('1. Plaats je handen naast je . 2. Hou je benen omhoog. 3. Til jezelf op met alleen je armen en herhaal dit.'),
        ]);



    }
}
