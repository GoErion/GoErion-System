<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @method static where(string $string, $firstOrFail)
 * @method static creating(\Closure $param)
 */
trait HasUuid
{
    protected static function bootHasUuid(): void
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Uuid::uuid4()->toString();
            }
        });
    }

    public function getKeyName(): string
    {
        return 'uuid';
    }

    public function getKeyType(): string
    {
        return 'string';
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public static function findByUuidOrFail(UuidInterface|string $uuid)
    {
        return static::where(
            'uuid',
            $uuid instanceof UuidInterface ? $uuid->toString() : $uuid
        )->firstOrFail();
    }
}
