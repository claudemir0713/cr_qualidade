<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $User=[
            [
                'name' => 'Djenifer',
                'email' => 'qualidade@ceramica',
                'password' => bcrypt('qualidade123')
            ],
            [
                'name' => 'Clovis Dorival Conzatti',
                'email' => 'clovis@plannersolucoes.com.br',
                'password' => bcrypt('Cczt4752')
            ],
            [
                'name' => 'Eder Bonessi',
                'email' => 'eder@ceramicalorenzetti.com.br',
                'password' => bcrypt('12345678')
            ]
        ];
        User::insert($User);
    }
}
