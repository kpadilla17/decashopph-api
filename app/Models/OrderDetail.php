<?php
/**
 * Class OrderDetail 
 *
 * @package App\Models
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class OrderDetail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'de_order_detail';
    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_order_detail';

    public function getOrderDetails($idOrder)
    {
        $orderDetails = DB::table($this->table)
            ->join('de_product', 'de_product.id_product', '=', 'de_order_detail.product_id')
            ->join('de_product_lang', 'de_product_lang.id_product', '=', 'de_product.id_product')
            ->join('de_manufacturer', 'de_manufacturer.id_manufacturer', '=', 'de_product.id_manufacturer')
            ->join('de_image', 'de_image.id_product', '=', 'de_product.id_product')
            ->where('id_order', $idOrder)
            ->groupBy('de_product.id_product')
            ->get();

        return $orderDetails;
    }

}