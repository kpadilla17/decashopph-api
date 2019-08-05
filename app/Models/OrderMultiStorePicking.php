<?php
/**
 * Class OrderCarrier 
 *
 * @package App\Models
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMultiStorePicking extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'de_order_multistorepicking';
    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_order_multistorepicking_order';
}