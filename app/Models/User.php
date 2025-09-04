<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;


    protected $primaryKey = 'user_id';
    public $incrementing = true;

    protected $guarded = ['role', 'wallet'];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'payment_user_id', 'user_id');
    }


    public function setPasswordAttribute($value){

        $this->attributes['password'] = bcrypt($value);
    }

    public function packages() {
        
        return $this->belongsToMany(Package::class, 'pivot_user_package', 'user_id', 'package_id')->withPivot(['amount','created_at','updated_at']);
    }

    public function subscribe(){

        return $this->hasMany(Subscribe::class, 'subscribe_user_id');

    }
}
