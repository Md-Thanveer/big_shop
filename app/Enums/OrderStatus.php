<?php 

namespace App\Enums;

enum OrderStatus: String

{
    case APPOINTMENT = 'APPOINTMENT';

    case PLACE_AN_ORDER = 'PLACE AN ORDER';

    case FABRIC_DISPATCHED = 'FABRIC DISPATCHED';

    case FABRIC_RECEIVED = 'FABRIC RECEIVED';

    case MANUFACTURING = 'MANFACTURING';

    case FINISHING = 'FINISHING';

    case GARMENT_COMPLETED = 'GARMENT COMPLETED';

    case ALTERATON_1 = 'ALTERATION 1';
    
    case ALTERATON_2 = 'ALTERATION 2';

    case DELIVERY = 'DELIVERY';

    public static function getValues(): array
    {
        return array_column(OrderStatus::cases(), 'value');
    }

    public static function getKeyValue(): array
    {
        return array_column(OrderStatus::cases(),'value'.'key');
    }
}