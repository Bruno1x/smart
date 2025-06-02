<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    protected $fillable = ['venda_id', 'produto_id', 'quantidade', 'valor_unitario'];

public function produto()
{
    return $this->belongsTo(\App\Models\Produto::class);
}
}
