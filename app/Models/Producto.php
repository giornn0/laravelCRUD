<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','descripcion'];
    public function etiquetas(){
        return $this->belongsToMany(Etiqueta::class);
    }
    public function ventas(){
        return $this->belongsToMany(Venta::class);
    }
}
