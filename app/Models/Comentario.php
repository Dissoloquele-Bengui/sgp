<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comentario extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [

        'txt_comentario' ,
        'it_id_curso',
        'it_id_curso',
        'it_id_user'

    ];
}
