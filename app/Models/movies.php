<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class movies extends Model
{
    protected $fillable = [
        'title',
        'genre',
        'release_date',
        'rating',
        'duration',
        'country',
        'description',
        'image',
    ];
    protected $casts = [
        'release_date' => 'date',
    ];
    protected $primaryKey = 'id';

    public $incrementing = true;
    protected $dates = ['deleted_at'];
}
