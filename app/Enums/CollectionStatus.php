<?php

namespace App\Enums;

enum CollectionStatus:String

{
    case PUBLISHED ='Published';

    case DRAFT ='Draft';

    case PENDING ='Pending';


    public static function getValues(): array
    {
        return array_column(CollectionStatus::cases(), 'value');
    }

    public static function getKeyValues():array
    {
        return array_column(CollectionStatus::cases(), 'value','key');
    }
}