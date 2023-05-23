<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PoliticalParty extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'political_parties';

    protected $guarded = [];

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class, 'political_party_id', 'id');
    }
}
