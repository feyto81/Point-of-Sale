<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Unit;
use App\Item;
use App\Supplier;

class Stock extends Model
{
    protected $table = 'stock';
    protected $primaryKey = 'stock_id';
    protected $guarded = [];

    public function Item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function Supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
