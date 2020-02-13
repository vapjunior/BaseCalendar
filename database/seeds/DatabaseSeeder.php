<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barbers')->insert([
            'email' => 'barber@email.com',
            'password' => bcrypt('123456'),
            'role' => '1',
            'name' => 'Allan John',
            'phone' => '14994754540',
        ]);

        DB::table('barbers')->insert([
            'email' => 'barbeiro@email.com',
            'password' => bcrypt('123456'),
            'role' => '1',
            'name' => 'Mike Crazy',
            'phone' => '14994752040',
        ]);

        DB::table('barbers')->insert([
            'email' => 'admin@email.com',
            'password' => bcrypt('123456'),
            'role' => '0',
            'name' => 'Administrador',
            'phone' => '14994751040',
        ]);

        DB::table('clients')->insert([
            'name' => 'Usuário Teste',
            'email' => 'user@email.com',
            'password' => bcrypt('123456'),
            'sex' => 'M',
            'phone' => '9',
            'birthDate' => '1990-01-01',
        ]);

        DB::table('clients')->insert([
            'name' => 'Cássio Viana',
            'email' => 'cassio@email.com',
            'password' => bcrypt('123456'),
            'sex' => 'M',
            'phone' => '99',
            'birthDate' => '1990-01-01',
        ]);
    }
}
