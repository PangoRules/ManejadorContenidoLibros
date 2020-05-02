<?php

use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias') -> insert([
        	'nombre' => 'Lírico',
        ]);    
        DB::table('categorias') -> insert([
        	'nombre' => 'Narrativo',
        ]);   
        DB::table('categorias') -> insert([
        	'nombre' => 'Dramatico',
        ]);   
        DB::table('categorias') -> insert([
        	'nombre' => 'Elegía',
        	'catPadre' => '1'
        ]);   
        DB::table('categorias') -> insert([
        	'nombre' => 'Satira',
        	'catPadre' => '1'
        ]);     
        DB::table('categorias') -> insert([
        	'nombre' => 'Oda',
        	'catPadre' => '1'
        ]);  
        DB::table('categorias') -> insert([
        	'nombre' => 'Cuento',
        	'catPadre' => '2'
        ]);   
        DB::table('categorias') -> insert([
        	'nombre' => 'Novela',
        	'catPadre' => '2'
        ]);     
        DB::table('categorias') -> insert([
        	'nombre' => 'Poema',
        	'catPadre' => '2'
        ]);   
        DB::table('categorias') -> insert([
        	'nombre' => 'Drama',
        	'catPadre' => '3'
        ]);   
        DB::table('categorias') -> insert([
        	'nombre' => 'Opera',
        	'catPadre' => '3'
        ]);     
        DB::table('categorias') -> insert([
        	'nombre' => 'Tragedia',
        	'catPadre' => '3'
        ]);      
    }
}
