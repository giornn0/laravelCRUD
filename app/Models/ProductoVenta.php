<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoVenta extends Model
{
    use HasFactory;
    protected $fillable=['venta_id','producto_id','cantidad','precio','total'];
    public $rules = array(
        'venta_id' =>'required|exists:ventas,id',
        'producto_id'=>'required|exists:productos,id',
        'cantidad'=>'required|integer',
        'precio'=>'required|integer',
        'total'=>'required|integer'
    );
}
