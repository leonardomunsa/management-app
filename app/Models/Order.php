<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'number';
    public $incrementing = false;

    protected $fillable = ['number', 'date', 'amount', 'finished', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'order_number', 'number');
    }
}
