<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyApiEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    //use billable;
    use Notifiable;
    public $timestamps = false;

    protected $table = 'users';
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'access_level', 'agent_id', 'admin_id', 'credit_card', 'address',
        'city', 'region', 'postal_code', 'country', 'mob_phone',
        'activated', 'avatar', 'remember_token'
    ];

    /**
     * Get dataset this model has
     * @return \App\Database\Eloquent\Relations\HasMany
     */
    public function stoves()
    {
        return $this->hasMany(Stove::Class);
    }

    /**
     * Get dataset this model has
     * @return \App\Database\Eloquent\Relations\HasMany
     */
    public function feedbacks()
    {
        return $this->hasMany(Feedback::Class);
    }

    /**
     * Get dataset this model has
     * @return \App\Database\Eloquent\Relations\belongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::Class);
    }

    /**
     * authorize roles
     * @param string|array $roles
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'this action is unauthorized');
        }
        return $this->hasRole($roles) ||
            abort(401, 'this action is unauthorized');
    }

    /**
     * Check multiple roles
     * @param array $roles
     */
    public function hasAnyRole($roles)
    {
        return $this->roles()->whereIn('name', $roles)->exists();
    }

    /**
     * Check one roles
     * @param string $roles
     */
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
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
    /**
     * send an email verification link to a user
     */
    public function sendApiEmailVerificationNotification()
    {
        $this->notify(new VerifyApiEmail);      //the custom notification
    }
}
