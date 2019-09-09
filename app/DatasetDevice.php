<?php

namespace App;

use Arados\Filters\Traits\Filterable;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * DatasetDevice Pivot Model
 * @extends Pivot
 */
class DatasetDevice extends Pivot
{
    use Filterable;

    /** @var string Filter Class */
    protected $filters = 'App\Filters\DatasetDeviceFilter';

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

    // TODO: Define other default value and relations
}
