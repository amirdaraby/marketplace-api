<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum PermissionsEnum: string
{
    use EnumToArray;

    case SELLER_STORE = "seller_store";

    case SELLER_UPDATE = "update_seller";

    case SELLER_DELETE = "seller_delete";

    case SELLER_SHOW = "seller_show";

    case CUSTOMER_STORE = "customer_store";

    case CUSTOMER_UPDATE = "customer_update";

    case CUSTOMER_DELETE = "customer_delete";

    case CUSTOMER_SHOW = "customer_show";

    case ADMIN_STORE = "admin_store";

    case ADMIN_UPDATE = "admin_update";

    case ADMIN_DELETE = "admin_delete";

    case ADMIN_SHOW = "admin_show";

}
