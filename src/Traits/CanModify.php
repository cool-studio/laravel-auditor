<?php

namespace CoolStudio\Auditor\Traits;

use CoolStudio\Auditor\Model\Audit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

trait CanModify
{
    public static function bootCanModify()
    {
        if (!is_subclass_of(self::class, Model::class)) {
            Log::error(self::class . ' cannot modify models, it is not a user. It does not extend ' . Model::class);
        }
    }

    public function auditModifications()
    {
        return $this->morphMany(Audit::class, 'user');
    }
}
