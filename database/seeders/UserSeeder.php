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
                'name' => 'Claudemir Ivanio Conzatti',
                'email' => 'claudemir@plannersolucoes.com.br',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'Clovis Dorival Conzatti',
                'email' => 'clovis@plannersolucoes.com.br',
                'password' => bcrypt('Cczt4752')
            ],
            [
                'name' => 'Eder Bonessi',
                'email' => 'eder@ceramicalorenzetti.com.br',
                'password' => bcrypt('123456')
            ]
        ];
        User::insert($User);
    }
}
