<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = [
        'description'
    ];

    public function users(): BelongsToMany{
        return $this->belongsToMany(User::class, env('DB_DATABASE') . '.role_user', 'role_id', 'user_id')->withTimestamps();
    }
}
