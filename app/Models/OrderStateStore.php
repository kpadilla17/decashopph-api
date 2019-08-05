<?php
/**
 * Class Order 
 *
 * @package App\Models
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStateStore extends Model
{
    protected $table = 'de_order_state_store';

    protected $primaryKey  = 'id_order_state_store';
}