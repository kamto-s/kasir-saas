<?php

namespace App\Enums;

enum RoleCode: string
{
    case SUPER_ADMIN = 'SUPER_ADMIN';
    case OWNER = 'OWNER';
    case CASHIER = 'CASHIER';
}
