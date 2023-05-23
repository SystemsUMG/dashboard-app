<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Municipality extends Model
{
    use HasFactory;

    protected $table = 'municipalities';

    protected $guarded = [];

    public function department(): HasOne
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function voters(): HasMany
    {
        return $this->hasMany(Voter::class, 'municipality_id', 'id');
    }
}
