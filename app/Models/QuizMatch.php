<?php

namespace App\Models;

use App\MatchType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizMatch extends Model
{
    use HasFactory;

    public $fillable = [
        'id',
        'local_team_id',
        'local_score',
        'guest_team_id',
        'guest_score',
        'type',
        'downloaded',
        'has_changed'
    ];

    protected $appends = [
        'search_string',
        'locale_type',
        'local_team_id_name',
        'guest_team_id_name'
    ];

    protected function searchString(): Attribute{
        return new Attribute(
            get: fn () => $this->localTeam->identifier_name . '_' . $this->guestTeam->identifier_name
        );
    }

    protected function localTeamIdName(): Attribute{
        return new Attribute(
            get: fn () => $this->localTeam->identifier_name
        );
    }

    protected function guestTeamIdName(): Attribute{
        return new Attribute(
            get: fn () => $this->guestTeam->identifier_name
        );
    }

    protected function localeType(): Attribute{
        return new Attribute(
            get: function () {
                $types = [
                    'regular' => 'Regular',
                    'quarter_final' => 'Cuartos de final',
                    'semi_final' => 'Semifinal',
                    'third' => 'Tercer Lugar',
                    'final' => 'Final'
                ];
                return $types[$this->type];
            }
        );
    }

    public function localTeam(): BelongsTo{
        return $this->belongsTo(Team::class, 'local_team_id');
    }

    public function guestTeam(): BelongsTo{
        return $this->belongsTo(Team::class, 'guest_team_id');
    }
}
