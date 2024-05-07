<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aula extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [

        'vc_title',
        'txt_description' ,
        'vc_thumb',
        'it_id_seccao',
        'it_id_curso'

    ];
}
