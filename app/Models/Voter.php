<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Voter extends Model
{
    use HasFactory;

    protected $table = 'voters';

    protected $fillable = [
        'name',
        'lastname',
        'cui',
        'municipality_id',
    ];

    public function municipality(): HasOne
    {
        return $this->hasOne(Municipality::class, 'id', 'municipality_id');
    }
}
