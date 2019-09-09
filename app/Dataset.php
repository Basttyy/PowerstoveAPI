<?php

namespace App;

use App\Database\Eloquent\Concerns;
use Arados\Filters\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * Dataset Model
 */
class Dataset extends Model
{
    use Filterable, Concerns\HasRelationships;

    /** @var string Filter Class */
    protected $filters = 'App\Filters\DatasetFilter';

    /** @var string $table */
    // protected $table = '';

    /** @var string $primaryKey */
    // protected $primaryKey = '';

    /** @var bool $incrementing */
    // public $incrementing = false;

    /** @var string $keyType */
    // protected $keyType = 'string';

    /** @var bool $timestamps */
    // public $timestamps = false;

    /** @var string $dateFormat */
    // protected $dateFormat = 'U';

    /** @var string CREATED_AT */
    // const CREATED_AT = '';
    /** @var string UPDATED_AT */
    // const UPDATED_AT = '';

    /** @var string $connection */
    // protected $connection = '';

    /**
     * Get data this model has
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function data()
    {
        return $this->hasMany(Datum::class);
    }

    /**
     * Get device this model belongs to
     * @return \App\Database\Eloquent\Relations\BelongsToOne
     */
    public function device()
    {
        return $this->belongsToOne(Device::class);
    }
}
