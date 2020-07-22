<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    protected $table = 'stockouts';
    protected $primaryKey = 'stockout_id';
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
