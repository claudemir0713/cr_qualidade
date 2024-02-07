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
                ,'ordem'         =>'01.001'
                , 'descricao'   =>'Menu'
                , 'tipo'        =>'Link'
                , 'rota'        =>'menu.listAll'
                , 'icone'       =>'fa fa-list'
            ],
            [
                'uuid'          => Uuid::uuid1()->toString()
                ,'ordem'         =>'01.002'
                , 'descricao'   =>'Menu Usuário'
                , 'tipo'        =>'Link'
                , 'rota'        =>'menu.menuUsuario'
                , 'icone'       =>'fas fa-user-cog'
            ],
            [
                'uuid'          => Uuid::uuid1()->toString()
                ,'ordem'         =>'01.010'
                , 'descricao'   =>'Moeda'
                , 'tipo'        =>'Link'
                , 'rota'        =>'moeda.listAll'
                , 'icone'       =>'fas fa-donate'
            ],
            [
                'uuid'          => Uuid::uuid1()->toString()
                ,'ordem'         =>'01.011'
                , 'descricao'   =>'Produto'
                , 'tipo'        =>'Link'
                , 'rota'        =>'produto.listAll'
                , 'icone'       =>'fas fa-funnel-dollar'
            ],

            [
                'uuid'          => Uuid::uuid1()->toString()
                ,'ordem'         =>'02.000'
                , 'descricao'   =>'Movimento'
                , 'tipo'        =>'Título'
                , 'rota'        =>''
                , 'icone'       =>''
            ],
            [
                'uuid'          => Uuid::uuid1()->toString()
                ,'ordem'         =>'02.001'
                , 'descricao'   =>'Orçamento'
                , 'tipo'        =>'Link'
                , 'rota'        =>'orcamento.listAll'
                , 'icone'       =>'fas fa-hand-holding-usd'
            ],

        ];

        menu::insert($menus);
    }
}
