<?php

namespace App\Services;

use Illuminate\Support\Collection;

enum DiscussionStatus: string
{
    case LIVE = 'live';
    case PAST = 'past';
    case UPCOMING = 'upcoming';

    public static function load($value): string|null
    {
        return self::tryFrom($value)?->name;
    }

    public static function values(): Collection
    {
        $values = collect();
        foreach (DiscussionStatus::cases() as $case) {
            $values->push($case->value);
        }

        return $values;
    }

    public static function caseValues(): Collection
    {
        $values = collect();
        foreach (DiscussionStatus::cases() as $case) {
            $values = $values->merge([
                $case->value => $case->name
            ]);
        }

        return $values;
    }
}
