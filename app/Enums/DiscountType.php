<?php

namespace App\Enums;

enum DiscountType:string
{
    case COUPON_CODE = 'Coupon Code';

    case PROMOTION = 'Promotion';

    public static function getValues(): array
    {
        return array_column(DiscountType::cases(), 'value');
    }

    public static function getKeyValues(): array
    {
        return array_column(DiscountType::cases(), 'value', 'Key');
    }

}