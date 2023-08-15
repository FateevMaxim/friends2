<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable =
        [
            'title',
            'title_kz'
        ];
    protected $hidden =
        [
            'created_at',
            'updated_at'
        ];
}
