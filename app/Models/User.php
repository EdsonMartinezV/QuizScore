<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nickname',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array{
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $appends = [
        'is_admin',
        'is_referee',
        'is_downloader',
        'is_able_to'
    ];

    protected function isAdmin(): Attribute{
        return new Attribute(
            get: fn () => $this->roles->filter(function ($role) {
                return $role->description === 'admin';
            })->count() === 1
        );
    }

    protected function isReferee(): Attribute{
        return new Attribute(
            get: fn () => $this->roles->filter(function ($role) {
                return $role->description === 'referee';
            })->count() === 1
        );
    }

    protected function isDownloader(): Attribute{
        return new Attribute(
            get: fn () => $this->roles->filter(function ($role) {
                return $role->description === 'downloader';
            })->count() === 1
        );
    }

    protected function isAbleTo(): Attribute{
        return new Attribute(
            get: fn () => [
                'users' => [
                    'create' => $this->can('create', User::class)
                ],
                'quiz_matches' => [
                    'view_any' => $this->can('viewAny', QuizMatch::class),
                    'create' => $this->can('create', QuizMatch::class),
                    'update' => $this->can('update', QuizMatch::class),
                    'delete' => $this->can('delete', QuizMatch::class),
                    'download' => $this->can('download', QuizMatch::class),
                ],
                'teams' => [
                    'view_any' => $this->can('viewAny', Team::class),
                    'create' => $this->can('create', Team::class),
                    'update' => $this->can('update', Team::class),
                    'delete' => $this->can('delete', Team::class),
                    'download' => $this->can('download', Team::class),
                ]
            ]
        );
    }

    public function roles(): BelongsToMany{
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
