<?php 

namespace App\Enums;

enum StockStatus:String
{
    case InStock ='In Stock';

    case OutOfStock ='Out Of Stock';

    case OnBackOrder ='On BackOrder';

    public static function getValues(): array
    {
        return array_column(StockStatus::cases(), 'value');
    }

    public static function getKeyValues():array
    {
        return array_column(StockStatus::cases(), 'value','key');
    }
}