<?php

namespace Database\Seeders;

use App\Models\menu;
use Ramsey\Uuid\Uuid;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        menu::truncate();
        $menus=[
            [
                'uuid'          => Uuid::uuid1()->toString()
                ,'ordem'        =>'01.000'
                , 'descricao'   =>'Cadastros'
                , 'tipo'        =>'Título'
                , 'rota'        =>''
                , 'icone'       =>''
            ],

            [
                'uuid'          => Uuid::uuid1()->toString()
                ,'ordem'         =>'02.000'
                , 'descricao'   =>'Produção'
                , 'tipo'        =>'Título'
                , 'rota'        =>''
                , 'icone'       =>''
            ],

            [
                'uuid'          => Uuid::uuid1()->toString()
                ,'ordem'         =>'03.000'
                , 'descricao'   =>'Apontamento de Produção'
                , 'tipo'        =>'Título'
                , 'rota'        =>''
                , 'icone'       =>''
            ],


        ];

        menu::insert($menus);
    }
}
