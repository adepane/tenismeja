<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'photo',
        'total_point',
        'l1_pts',
    ];


    public function getTotalPointAttribute()
    {
        $tPoints = $this->attributes['total_point'] + $this->attributes['l1_pts'];
        return $tPoints;
    }

    /**
     * Get all of the matchesGame for the Player
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function playerWin(): HasMany
    {
        return $this->hasMany(PlayerMatch::class, 'winner', 'id');
    }

    /**
     * Get all of the matchesGame for the Player
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function playerLost(): HasMany
    {
        return $this->hasMany(PlayerMatch::class, 'loser', 'id');
    }

    /**
     * Get all of the matchesGame for the Player
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function homeGame(): HasMany
    {
        return $this->hasMany(PlayerMatch::class, 'home_id', 'id')->where('finish',1);
    }

    /**
     * Get all of the matchesGame for the Player
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function awayGame(): HasMany
    {
        return $this->hasMany(PlayerMatch::class, 'away_id', 'id')->where('finish', 1);
    }
}
