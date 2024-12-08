<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sale extends Model
{
    protected $keyType = 'string';
    protected $primaryKey = 'uuid';
    public $incrementing = false;

    protected $fillable = ['uuid', 'details', 'amount', 'paid', 'order_id', 'client_uuid'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_uuid', 'uuid');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($sale) {
            if (empty($sale->uuid)) {
                $sale->uuid = Str::uuid();
            }
        });
    }
}

