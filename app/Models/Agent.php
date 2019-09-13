<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Agent extends Authenticatable implements JWTsubject
{
    //use billable;
    use Notifiable;
    public $timestamps = false;

    protected $table = 'agents';
    protected $primaryKey = 'id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'credit_card', 'address',
        'city', 'region', 'postal_code', 'country', 'mob_phone',
        'activated', 'avatar', 'remember_token'
    ];

    /**
     * Get dataset this model has
     * @return \App\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::Class);
    }

    /**
     * Get dataset this model belongs to
     * @return \App\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->BelongsTo(Admin::Class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
