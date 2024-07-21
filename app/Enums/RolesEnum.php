<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum RolesEnum: string
{
    use EnumToArray;

    case SELLER = "seller";

    case CUSTOMER = "customer";

    case ADMIN = "admin";
}
