<?php

use App\Moneda;
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
        factory(App\Moneda::class,500)->create();
        // $this->call(UsuarioSeeder::class);

    }
}
