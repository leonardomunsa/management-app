<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $keyType = 'string';
    protected $primaryKey = 'uuid';
    public $incrementing = false;

    protected $fillable = ['uuid', 'name', 'cnpj', 'address', 'number'];

    public function sales()
    {
        return $this->hasMany(Sale::class, 'client_uuid', 'uuid');
    }
}

