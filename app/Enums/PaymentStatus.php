<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = "pending";
    case SETTLEMENT = "settlement";
    case CHALLENGE = "challenge";
    case DENY = "deny";
    case EXPIRE = "expire";
    case CANCEL = "cancel";
    case CAPTURE = "capture";
    case FAILED = "failed";
}
