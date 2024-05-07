<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seccao extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [

        'vc_title',
        'txt_description' ,
        'it_number',
        'it_id_curso'

    ];
}
