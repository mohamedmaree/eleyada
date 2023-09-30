<?php

namespace App\Services;
enum OrderStatus: string
{
    case IN_PROGRESS = 'in_progress';
    case CANCELED = 'canceled';
    case DELIVERED = 'delivered';
    case CONFIRMED = 'confirmed';

    public static function load($value): string|null
    {
        return self::tryFrom($value)?->name;
    }
}
