<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'active',
    ];

    public function users()
    {
        $this->hasMany(User::class);
    }
}
