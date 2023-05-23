<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Vote extends Model
{
    use HasFactory;

    protected $table = 'votes';

    protected $fillable = [
        'voter_id',
        'political_party_id',
    ];

    public function political_party(): HasOne
    {
        return $this->hasOne(PoliticalParty::class, 'id', 'political_party_id');
    }

    public function voter(): HasOne
    {
        return $this->hasOne(Voter::class, 'id', 'voter_id');
    }
}
