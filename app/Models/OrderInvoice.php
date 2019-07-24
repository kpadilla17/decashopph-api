<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * 
 */
class OrderInvoice extends Model
{

    const STATUS_IN_PROGRESS = 222;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'de_order_invoice';
    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_order_invoice';

    public function getInProgressOrders()
    {
        $orders = DB::table($this->table)
            ->join('de_orders', 'de_orders.id_order', '=', 'de_order_invoice.id_order')
            ->whereIn('de_orders.current_state', [self::STATUS_IN_PROGRESS])
            ->get();

        return $orders;
    }
}