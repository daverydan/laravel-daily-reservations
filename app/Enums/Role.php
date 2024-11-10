<?php

namespace App\Enums;

enum Role: int
{
    case ADMINISTRATOR = 1;
    case COMPANY_OWNER = 2;
    case CUSTOMER = 3;
    case GUIDE = 4;

    public static function toString(int $type): string
    {
        return match ($type) {
            self::ADMINISTRATOR->value => 'administrator',
            self::COMPANY_OWNER->value => 'company owner',
            self::CUSTOMER->value => 'customer',
            self::GUIDE->value => 'guide',
        };
    }
}
