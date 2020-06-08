<?php

use Illuminate\Database\Seeder;
use App\categorias;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria = categorias::create([
        	'nombre_cat' => 'Lírico',
        ])->users()->attach([3]);    

        //$categoria = categorias::find(1);
        //$categoria->users()->attach([2]);

        $categoria = categorias::create([
        	'nombre_cat' => 'Narrativo',
        ])->users()->attach([3]);   
        $categoria = categorias::create([
        	'nombre_cat' => 'Dramático',
        ])->users()->attach([3]);   
        $categoria = categorias::create([
        	'nombre_cat' => 'Elegía',
        	'catPadre' => '1'
        ])->users()->attach([3]);   
        $categoria = categorias::create([
        	'nombre_cat' => 'Satira',
        	'catPadre' => '1'
        ])->users()->attach([3]);     
        $categoria = categorias::create([
        	'nombre_cat' => 'Oda',
        	'catPadre' => '1'
        ])->users()->attach([3]);  
        $categoria = categorias::create([
        	'nombre_cat' => 'Cuento',
        	'catPadre' => '2'
        ])->users()->attach([3]);   
        $categoria = categorias::create([
        	'nombre_cat' => 'Novela',
        	'catPadre' => '2'
        ])->users()->attach([3]);     
        $categoria = categorias::create([
        	'nombre_cat' => 'Poema',
        	'catPadre' => '2'
        ])->users()->attach([3]);   
        $categoria = categorias::create([
        	'nombre_cat' => 'Drama',
        	'catPadre' => '3'
        ])->users()->attach([3]);   
        $categoria = categorias::create([
        	'nombre_cat' => 'Opera',
        	'catPadre' => '3'
        ])->users()->attach([3]);     
        $categoria = categorias::create([
        	'nombre_cat' => 'Tragedia',
        	'catPadre' => '3'
        ])->users()->attach([3]);      
    }
}
