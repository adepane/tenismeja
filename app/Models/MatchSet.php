<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MatchSet extends Model
{
    // use HasFactory;
    protected $table = 'match_sets';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'player_match_id',
        'home_score',
        'away_score',
        'finish',
        'set_of_match',
    ];

    /**
     * Get the getPlayerMatch that owns the MatchSet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getPlayerMatch(): BelongsTo
    {
        return $this->belongsTo(PlayerMatch::class, 'player_match_id', 'id');
    }
}
