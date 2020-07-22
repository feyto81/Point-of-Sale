<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class LogActivity extends Model
{
    protected $table = 'log_activity';
    protected $fillable = [
        'subject', 'url', 'method', 'ip', 'agent', 'user_id'
    ];

     public function Nama()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
