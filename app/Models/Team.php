<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    public $fillable =[
        'name',
        'won_matches',
        'lost_matches',
        'drawn_matches',
        'scored_points',
        'conceded_points'
    ];

    protected $appends = [
        'identifier_name',
        'played_matches'
    ];

    protected function identifierName(): Attribute{
        return new Attribute(
            get: fn () => strtolower(str_replace([' ', "'"], ['_', ''], iconv('utf-8', 'ASCII//TRANSLIT', $this->name)))
        );
    }

    protected function playedMatches(): Attribute{
        return new Attribute(
            get: fn () => $this->won_matches + $this->lost_matches
        );
    }

    public function asLocalQuizMatches(): HasMany{
        return $this->hasMany(QuizMatch::class, 'local_team_id');
    }

    public function asGuestQuizMatches(): HasMany{
        return $this->hasMany(QuizMatch::class, 'guest_team_id');
    }
}
