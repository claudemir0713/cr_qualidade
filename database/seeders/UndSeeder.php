<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Und;

class UndSeeder extends Seeder
{
    public function run()
    {
        Und::truncate();
        $und=[
            [
                'und'=>'Pc'
            ],
            [
                'und'=>'Kg'
            ],
            [
                'und'=>'Und'
            ],
            [
                'und'=>'Mt'
            ],
            [
                'und'=>'Pct'
            ],
            [
                'und'=>'Hr'
            ],
            [
                'und'=>'Cx'
            ],
        ];
        Und::insert($und);
    }
}
