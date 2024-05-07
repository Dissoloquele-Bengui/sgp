<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaInfo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'vc_nome',
    ];
}
