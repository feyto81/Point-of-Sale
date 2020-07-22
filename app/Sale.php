<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Sale extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'sale_id';
    protected $guarded = [];


    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
