<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'SergioV',
            'email' => 'sergiovargas9@gmail.com',
            'password' => \Hash::make('123456789As*'),
            'email_verified_at' => \Carbon\carbon::now(),
        ]);

        \DB::table('products')->insert([
            'name' => 'Pantalon',
            'value' => 10,
            'description' => 'pantaloneta'
        ]);

        \DB::table('products')->insert([
            'name' => 'Pantalon',
            'value' => 10,
            'description' => 'pantaloneta'
        ]);

        \DB::table('products')->insert([
            'name' => 'Camisa',
            'value' => 10,
            'description' => 'Camisa'
        ]);

        \DB::table('products')->insert([
            'name' => 'Bota2',
            'value' => 10,
            'description' => 'La Bota numero 2'
        ]);

        \DB::table('attributes')->insert([
            'name' => 'Azul',
            'type' => 'Color'
        ]);

        \DB::table('attributes')->insert([
            'name' => 'Rojo',
            'type' => 'Color'
        ]);

        \DB::table('attributes')->insert([
            'name' => 'Grande',
            'type' => 'Talla'
        ]);

        \DB::table('attributes')->insert([
            'name' => 'Peque',
            'type' => 'Talla'
        ]);

        \DB::table('attributes')->insert([
            'name' => 'MarcaA',
            'type' => 'Marca'
        ]);

        \DB::table('attributes')->insert([
            'name' => 'MarcaB',
            'type' => 'Marca'
        ]);
    }
}
