<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeedBack extends Model
{ use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'feedback',
        'id_user',
        'id_curso'
    ];
}
