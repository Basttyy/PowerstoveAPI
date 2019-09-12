<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Stove Model
 */
class Stove extends Authenticatable
{
    /** @var string $primaryKey */
    protected $primaryKey = 'imei';

    /** @var string $table */
    protected $table = 'stoves';

    /** @var bool $incrementing */
    public $incrementing = false;

    /** @var string $keyType */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'imei', 'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'api_token',
    ];

    /**
     * Get dataset this model has
     * @return \App\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->BelongsTo(App/Models/User::Class);
    }

    /**
     * Get dataset this model belongs to
     * @return \App\Database\Eloquent\Relations\BelongsTo
     */
    public function admins()
    {
        return $this->hasMany(App/Models/Admin::Class);
    }

    /**
     * Get device_logs this model has
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function device_logs()
    {
        return $this->hasMany(DeviceLog::class);
    }

    /**
     * Get dataset this model belongs to
     * @return \App\Database\Eloquent\Relations\BelongsToOne
     */
    public function dataset()
    {
        return $this->belongsToOne(Dataset::class);
    }

    /**
     * Get data this model has
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function data()
    {
        return $this->hasManyThrough(Datum::class, DatasetDevice::class, null, (new Dataset)->getForeignKey(), null, (new Dataset)->getForeignKey());
    }
}
