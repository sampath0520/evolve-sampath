<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    //add fillable property
    protected $fillable = [
        'name',
        'email',
        'active',
    ];
}
