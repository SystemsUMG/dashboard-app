<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Department extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function municipalities(): HasMany
    {
        return $this->hasMany(Municipality::class, 'department_id', 'id');
    }
}
