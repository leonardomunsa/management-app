<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Client extends Model
{
    protected $keyType = 'string';
    protected $primaryKey = 'uuid';
    public $incrementing = false;

    protected $fillable = ['uuid', 'name', 'cnpj', 'address', 'number', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'client_uuid', 'uuid');
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

    public static function findByCnpj(string $cnpj): ?Client
    {
        return self::where('cnpj', $cnpj)->first();
    }
}

