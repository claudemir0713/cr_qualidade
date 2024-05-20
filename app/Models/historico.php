<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historico extends Model
{
    use HasFactory;
    protected $fillable= [
        'id'
        , 'historico'
    ];
    protected $primaryKey = 'id';
    protected $table = 'historico';

}
