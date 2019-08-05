<?php
/**
 * Class Order 
 *
 * @package App\Models
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'de_customer';

    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_customer';

    /**
     * Get the phone record associated with the user.
     */
    public function order()
    {
        return $this->hasMany('App\Models\Order', 'id_order');
    }
}