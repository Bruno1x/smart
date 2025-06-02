<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = ['cliente_id', 'total'];

public function cliente()
{
    return $this->belongsTo(\App\Models\Cliente::class);
}

public function itens()
{
    return $this->hasMany(\App\Models\ItemVenda::class);
}
}
