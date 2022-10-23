<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait UsesUuid {
    /**
     * Boot function from Laravel.
     */
    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->uuidColumn} = Str::uuid()->toString();
        });
    }

}
