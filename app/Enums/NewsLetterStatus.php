<?php 

namespace App\Enums;

enum NewsLetterStatus:String
{
    case SUBSCRIBE ='Subscribe';

    case UNSUBSCRIBE ='Unsubscribe';


    public static function getValues(): array
    {
        return array_column(NewsLetterStatus::cases(), 'value');
    }

    public static function getKeyValues():array
    {
        return array_column(NewsLetterStatus::cases(), 'value','key');
    }
}