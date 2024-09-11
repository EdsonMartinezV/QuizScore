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
        'points_scored',
        'points_conceded'
    ];

    protected $appends = [
        'identifier_name'
    ];

    protected function identifierName(): Attribute{
        return new Attribute(
            get: fn () => str_replace([' ', "'"], '', iconv('utf-8', 'ASCII//TRANSLIT', $this->name))
        );
    }

    public function asLocalQuizMatches(): HasMany{
        return $this->hasMany(QuizMatch::class, 'local_team_id');
    }

    public function asGuestQuizMatches(): HasMany{
        return $this->hasMany(QuizMatch::class, 'guest_team_id');
    }
}
