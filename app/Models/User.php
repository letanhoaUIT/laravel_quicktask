<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'email',
    //     'password',
    //     'first_name',
    //     'last_name',
    //     'is_active',
    //     'username'
    // ];

    protected $guard=[ //them is_admin vào blacklist
        'is_admin'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tasks(): HasMany {
        return $this->hasMany(Task::class);
    }

    public function roles(): BelongsToMany {
        return $this->belongsToMany(Role::class);
    }

    protected function fullname(): Attribute
    {
        return Attribute::make (
            get: fn ($value) => $this->attributes['first_name'].' '.$this->attributes['last_name'],
        );
    }

    protected function username(): Attribute
    {
        return Attribute::make (
            set: fn ($value) => Str::slug($value),
        );
    }
}
