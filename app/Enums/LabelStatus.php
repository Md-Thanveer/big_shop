<?php

namespace App\Enums;

enum LabelStatus:string
{
    case Processing = 'processing';

    case Active = 'Active';

    case Hide = 'Hide';

    public static function getValues(): array
    {
        return array_column(LabelStatus::cases(), 'value');
    }

    public static function getKeyValues(): array
    {
        return array_column(LabelStatus::cases(), 'value', 'Key');
    }

}