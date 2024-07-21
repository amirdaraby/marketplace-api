<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum PermissionsEnum: string
{
    use EnumToArray;

    case USER_SHOW = 'user.show';
    case USER_UPDATE = 'user.update';
    case USER_DELETE = 'user.delete';
    case SELLER_SHOW = 'seller.show';
    case SELLER_UPDATE = 'seller.update';
    case SELLER_DELETE = 'seller.delete';
    case PRODUCT_UPDATE = 'product.update';
    case PRODUCT_DELETE = 'product.delete';
}
