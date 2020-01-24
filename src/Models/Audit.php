<?php

namespace CoolStudio\Auditor\Model;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    const UPDATED_AT = null;

    public const CREATED = 'created';
    public const UPDATED = 'updated';
    public const DELETED = 'deleted';

    protected $table = 'auditor_audit';

    protected $casts = [
        'old' => 'array',
        'new' => 'array'
    ];

    public function user()
    {
        return $this->morphTo('user');
    }

    public function object()
    {
        return $this->morphTo('object');
    }
}
