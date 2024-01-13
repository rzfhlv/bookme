<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = "pending";
    case SUCCESS = "success";
    case CANCELLED = "cancelled";
    case FAILED = "failed";
}
