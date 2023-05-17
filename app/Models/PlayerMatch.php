<?php

namespace App\Models;

use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlayerMatch extends Model
{
    use HasFactory;

    protected $table = 'player_matchs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'home_id',
        'away_id',
        'home_score',
        'away_score',
        'finish',
    ];

    /**
     * Get the playerHome that owns the PlayerMatch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function playerHome(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'home_id', 'id');
    }

    /**
     * Get the playerAway that owns the PlayerMatch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function playerAway(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'away_id', 'id');
    }

    /**
     * Get all of the getMatchSets for the PlayerMatch
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getMatchSets(): HasMany
    {
        return $this->hasMany(MatchSet::class, 'player_match_id', 'id');
    }
}
