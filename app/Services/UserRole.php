<?php

namespace App\Services;
enum UserRole: string
{
    case PREGNANT = 'pregnant';
    case NON_PREGNANT = 'non-pregnant';
    case NORMAL = 'normal';

    public static function load($value): string|null
    {
        return self::tryFrom($value)?->name;
    }
}
