<?php
/**
 * Class OrderInvoice 
 *
 * @package App\Models
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class OrderInvoice extends Model
{
    const STATUS_ALABANG_IN_PROGRESS    = 222;
    const STATUS_ALABANG_IN_PROGRESS_OT = 205;

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

    /**
     * Fetch all in progress orders with print delivery slips enabled.
     * 
     * @return array
     */
    public function getInProgressOrders()
    {
        $orders = DB::table($this->table)
            ->join('de_orders', 'de_orders.id_order', '=', 'de_order_invoice.id_order')
            ->join('de_order_state', 'de_order_state.id_order_state', '=', 'de_orders.current_state')
            ->where('de_order_state.print_delivery', '=', 1)
            ->whereIn('de_orders.current_state', [self::STATUS_ALABANG_IN_PROGRESS, self::STATUS_ALABANG_IN_PROGRESS_OT])
            ->get();

        return $orders;
    }
}