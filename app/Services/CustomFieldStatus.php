<?php

namespace App\Services;

use Illuminate\Support\Collection;

enum CustomFieldStatus:string
{
    case ADD = 'add';
    case REMOVE = 'remove';

    public static function caseValues(): Collection
    {
        $values = collect();
        foreach (self::cases() as $case) {
            $values = $values->merge([
                $case->value => $case->name
            ]);
        }

        return $values;
    }
}
