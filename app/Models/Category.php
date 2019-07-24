<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'de_category';
	
	/**
	 * The primary key associated with the table.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id_category';

	public function getProductCategory($idProduct)
	{
		$productCategory = DB::table(DB::raw('de_category child, de_category parent'))
			->select('parent.id_category', 'name')
			->leftJoin('de_category_lang', 'de_category_lang.id_category', '=', 'parent.id_category')
		    ->where('child.nleft', '>=', DB::raw('parent.nleft'))
		    ->where('child.nleft', '<=', DB::raw('parent.nright'))
		    ->where('child.id_category', function($query) use ($idProduct) {
		    	$query->select('id_category_default')
		    		->from('de_product')
		    		->where('id_product', '=', $idProduct);
		    })
		    ->where('parent.id_parent', '=', '1001')
		    ->first();

		return $productCategory;
	}
}