<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Perro;

class PerroSeeder extends Seeder
{
    public function run()
    {
        Perro::create([
            'id' => '1',
            'nombre' => 'Diego',
            'foto_url' => 'https://ejemplo.com/foto1.jpg',
            'descripcion' => 'Diego es un perro.',
        ]);

        Perro::create([
            'id' => '2',
            'nombre' => 'Max',
            'foto_url' => 'https://ejemplo.com/foto2.jpg',
            'descripcion' => 'Max es un perro.',
           
        ]);

        Perro::create([
            'id' => '3',
            'nombre' => 'Joaquin',
            'foto_url' => 'https://ejemplo.com/foto3.jpg',
            'descripcion' => 'Joaquin es un perro.',
        ]);

        Perro::create([
            'id' => '4',
            'nombre' => 'Maxi',
            'foto_url' => 'https://ejemplo.com/foto4.jpg',
            'descripcion' => 'Maxi es un perro.',
           
        ]);

       
    }
}
