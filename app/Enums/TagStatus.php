<?php

namespace App\Enums;

enum TagStatus:String
{
    case PUBLISHED = 'Published';

    case DRAFT = 'Draft';

    case PENDING = 'Pending';

    public static function getValues(): array
    {
        return array_column(TagStatus::cases(), 'value');
    }

    public static function getKeyValues(): array
    {
        return array_column(TagStatus::cases(), 'value', 'key');
    }

}