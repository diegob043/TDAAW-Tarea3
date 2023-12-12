<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Interaccion;

class interacionSeeder extends Seeder
{
    public function run()
    {
        Interaccion::create([
            'PerroInteresado_id' => '1',
            'PerroCandidato_id' => '4',
            'preferencia' => 'A'
        ]);

        Interaccion::create([
            'PerroInteresado_id' => '1',
            'PerroCandidato_id' => '7',
            'preferencia' => 'A'
        ]);

        Interaccion::create([
            'PerroInteresado_id' => '1',
            'PerroCandidato_id' => '9',
            'preferencia' => 'A'
        ]);

        Interaccion::create([
            'PerroInteresado_id' => '2',
            'PerroCandidato_id' => '4',
            'preferencia' => 'R'
        ]);

        Interaccion::create([
            'PerroInteresado_id' => '2',
            'PerroCandidato_id' => '7',
            'preferencia' => 'R'
        ]);

        Interaccion::create([
            'PerroInteresado_id' => '2',
            'PerroCandidato_id' => '9',
            'preferencia' => 'R'
        ]);

        
    
    }
}
