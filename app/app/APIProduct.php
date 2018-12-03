<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class APIProduct extends Model
{
    protected $fillable = [
        'name', 'detail'
    ];
}
