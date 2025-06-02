<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Produto extends Model
{
    protected $fillable = ['descricao', 'valor', 'marca_id'];

public function marca()
{
    return $this->belongsTo(Marca::class);
}
}
