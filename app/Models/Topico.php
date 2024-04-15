<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topico extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'numero',
        'topico',
        'capa',
        'descricao',
        'id_curso'
    ];
}
