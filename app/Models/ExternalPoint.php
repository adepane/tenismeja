<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalPoint extends Model
{
    use HasFactory;

    protected $table = 'external_points';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'player_id',
        'points',
    ];
}
