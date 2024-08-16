<?php 

namespace App\Enums;

enum PaymentMethod: String

{
    case CASH = 'cash';

    case UPI = 'UPI';

    case CARD = 'CARD';

    public static function getValues(): array
    {
        return array_coloumn(PaymentMethod::cases(),'value');
    }

    public static function getKeyValues(): array
    {
        return array_coloumn(PaymentMethod::cases(),'value','key');
    }

}

 
