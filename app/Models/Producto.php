<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','descripcion','etiquetas'];
    public function etiquetas(){
        return $this->belongsToMany(Etiqueta::class);
    }
    public function ventas(){
        return $this->belongsToMany(Venta::class);
    }
    public $rules= array(
        'nombre'=>'required|max:100',
        'descripcion'=>'max:255',
        'etiquetas'=>'array|max:3|required',
        'etiquetas.*'=>'integer|exists:etiquetas,id'
    );
}
