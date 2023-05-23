<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliticalPartie extends Model
{
    use HasFactory;

    protected $table = 'political_parties';
    protected $fillable = [
        'name',
        'color',
        'image',
        'active',
    ];

}
