<?php

namespace App\Enums;

enum Role: int
{
    case ADMINISTRATOR = 1;
    case COMPANY_OWNER = 2;
    case CUSTOMER = 3;
    case GUIDE = 4;

    public function toString(): string
    {
        return strtolower(str_replace('_', ' ', $this->name));
    }
}
