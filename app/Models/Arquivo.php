<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Arquivo extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'url',
        'tamanho',
        'tipo_arquivo',
        'id_topico'
    ];
}
