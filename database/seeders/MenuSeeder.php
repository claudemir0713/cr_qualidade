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
                ,'ordem'        =>'01.001'
                , 'descricao'   =>'Produto'
                , 'tipo'        =>'Link'
                , 'rota'        =>'produto.listAll'
                , 'icone'       =>'fas fa-cubes'
            ],
            [
                'uuid'          => Uuid::uuid1()->toString()
                ,'ordem'        =>'01.002'
                , 'descricao'   =>'Maquinas'
                , 'tipo'        =>'Link'
                , 'rota'        =>'maquina.listAll'
                , 'icone'       =>'fas fa-cogs'
            ],
            [
                'uuid'          => Uuid::uuid1()->toString()
                ,'ordem'        =>'01.002'
                , 'descricao'   =>'Historicos'
                , 'tipo'        =>'Link'
                , 'rota'        =>'historico.listAll'
                , 'icone'       =>'far fa-clone'
            ],

            [
                'uuid'          => Uuid::uuid1()->toString()
                ,'ordem'         =>'02.000'
                , 'descricao'   =>'Apontamentos'
                , 'tipo'        =>'Título'
                , 'rota'        =>''
                , 'icone'       =>''
            ],
            [
                'uuid'          => Uuid::uuid1()->toString()
                ,'ordem'        =>'02.001'
                , 'descricao'   =>'Extrusora'
                , 'tipo'        =>'Link'
                , 'rota'        =>'extrusora.listAll'
                , 'icone'       =>'far fa-edit'
            ],
            [
                'uuid'          => Uuid::uuid1()->toString()
                ,'ordem'        =>'02.002'
                , 'descricao'   =>'Carga Vagão'
                , 'tipo'        =>'Link'
                , 'rota'        =>'cargavagao.listAll'
                , 'icone'       =>'fas fa-chevron-down'
            ],
            [
                'uuid'          => Uuid::uuid1()->toString()
                ,'ordem'        =>'02.003'
                , 'descricao'   =>'Forno'
                , 'tipo'        =>'Link'
                , 'rota'        =>'forno.listAll'
                , 'icone'       =>'fas fa-igloo'
            ],
            [
                'uuid'          => Uuid::uuid1()->toString()
                ,'ordem'        =>'02.004'
                , 'descricao'   =>'Laboratorio'
                , 'tipo'        =>'Link'
                , 'rota'        =>'laboratorio.listAll'
                , 'icone'       =>'fas fa-flask'
            ],

        ];

        menu::insert($menus);
    }
}
