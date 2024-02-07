<?php

namespace Database\Seeders;

use App\Models\menu;
use App\Models\menuUsuario;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class MenuUsuarioSeeder extends Seeder
{
    public function run()
    {
        menuUsuario::truncate();
        $id_useres = User::get(['id']);
        foreach($id_useres as $id_user){
            $uuid = Uuid::uuid1()->toString();
            $menu = "INSERT menuusuario(uuid,usuarioId, menuId) (SELECT '$uuid',$id_user->id, id FROM menu)";
            DB::insert($menu);
        }
    }
}
