<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = $faker = Faker\Factory::create();
        $tests = array(
            [
                'name' => 'Administrador',
                'email' => 'admin@admin.com',
                'level' => 'admin',
                'password' => bcrypt('12345678')
            ]
        );

        foreach ($tests as $key) {
            DB::table('usuarios')->insert($key);
        }
    }
}
