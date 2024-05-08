<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anexo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'vc_title',
        'txt_description' ,
        'vc_file',
        'vc_thumb',
        'tm_duraction',
        'it_id_aula',
        'it_id_categoriaAnexo'
    ];
}
