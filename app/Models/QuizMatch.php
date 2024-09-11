<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizMatch extends Model
{
    use HasFactory;

    public $fillable = [
        'local_team_id',
        'local_score',
        'guest_team_id',
        'guest_score'
    ];

    public function team1(): BelongsTo{
        return $this->belongsTo(Team::class, 'local_team_id');
    }

    public function team2(): BelongsTo{
        return $this->belongsTo(Team::class, 'guest_team_id');
    }
}
