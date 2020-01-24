<?php

namespace CoolStudio\Auditor\Traits;

use CoolStudio\Auditor\Model\Audit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

trait IsAudited
{
    public static function bootIsAudited()
    {
        if (!is_subclass_of(self::class, Model::class)) {
            Log::error(self::class . ' cannot be audited. It does not extend ' . Model::class);
            return;
        }

        self::created(function ($model) {
            $audit = new Audit();
            $audit->event = Audit::CREATED;

            $audit->original = [];
            $audit->new = $model->attributes;

            $user = app('request')->user;
            if ($user) {
                $audit->user()->associate($user);
            }

            $audit->object()->associate($model);
            $audit->save();
        });

        self::updated(function ($model) {
            $audit = new Audit();
            $audit->event = Audit::UPDATED;

            $original = [];
            foreach (array_keys($model->changes) as $key) {
                $original[$key] = $model->original[$key];
            }

            $audit->old = $original;
            $audit->new = $model->changes;

            $user = app('request')->user;
            if ($user) {
                $audit->user()->associate($user);
            }

            $audit->object()->associate($model);
            $audit->save();
        });

        self::deleted(function ($model) {
            $audit = new Audit();
            $audit->event = Audit::DELETED;

            $audit->old = $model->attributes;

            $user = app('request')->user;
            if ($user) {
                $audit->user()->associate($user);
            }

            $audit->object()->associate($model);
            $audit->save();
        });
    }

    public function audits()
    {
        return $this->morphMany(Audit::class, 'object');
    }
}
