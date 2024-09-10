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

    protected $connection = 'mysqlsystem';
    protected $table = 'ISSTECH_SYSTEM.Tbl_Usuario_Login';
    protected $primaryKey = 'Pk_Usuario_Login';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'paternal_surname',
        'maternal_surname',
        'email',
        'professional_license',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'Password',
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
        'full_name',
        'professional_license',
        'is_admin',
        'is_able_to'
    ];

    protected function fullName(): Attribute{
        return new Attribute(
            get: fn () => "$this->Nombre_Usuario $this->Apellido_Paterno_Usuario $this->Apellido_Materno_Usuario"
        );
    }

    protected function professionalLicense(): Attribute{
        return new Attribute(
            get: fn () => $this->Pk_Usuario_Login === 2453 ? '13851640' : $this->doctor->Cedula_Medico
        );
    }

    protected function isAdmin(): Attribute{
        return new Attribute(
            get: fn () => $this->roles->filter(function ($role) {
                return $role->description === 'admin';
            })->count() === 1
        );
    }

    protected function isAbleTo(): Attribute{
        return new Attribute(
            get: fn () => $this->isAbleToArray()
        );
    }

    public function roles(): BelongsToMany{
        return $this->belongsToMany(Role::class, env('DB_DATABASE') . '.role_user', 'user_id', 'role_id')->withTimestamps();
    }

    protected function isAbleToArray(): array{
        return [];
    }
}
