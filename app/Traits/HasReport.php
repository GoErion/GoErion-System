<?php

namespace App\Traits;

use App\Models\Report;

/**
 * @method static creating(\Closure $param)
 * @method static created(\Closure $param)
 * @method static updating(\Closure $param)
 * @method static deleted(\Closure $param)
 */
trait HasReport
{
    public static function bootHasReports(): void
    {
        static::created(function ($model) {
            self::logReport('created', $model, null, $model->toArray());
        });

        static::updating(function ($model) {
            self::logReport('updated', $model, $model->getOriginal(), $model->getChanges());
        });

        static::deleted(function ($model) {
            self::logReport('deleted', $model, $model->toArray(), null);
        });
    }

    protected static function logReport(string $action, $model, $oldData = null, $newData = null): void
    {
        // Skip if user is not authenticated (optional)
        $userId = auth()->id() ?? null;

        Report::create([
            'user_id'   => $userId,
            'action'    => $action,
            'model'     => get_class($model),
            'model_id'  => $model->id,
            'old_data'  => $oldData ? json_encode($oldData) : null,
            'new_data'  => $newData ? json_encode($newData) : null,
        ]);
    }
}
