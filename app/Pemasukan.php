<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'pemasukans';
    protected $primaryKey = 'pemasukan_id';
    protected $guarded = [];
}
