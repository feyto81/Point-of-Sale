<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Unit;

class Item extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'item_id';
    protected $fillable = ['barcode', 'name', 'category_id', 'unit_id', 'price', 'stock', 'image'];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function Unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
