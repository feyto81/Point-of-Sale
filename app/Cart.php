<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'cart_id';
    protected $guarded = [];

    public function Item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
