<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    public function clientes()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function productos()
    {
        return $this->belongsToMany(Producto::class);
    }
    protected $fillable = ['cliente_id', 'monto', 'fecha'];
    public $rules = array(
        'cliente_id' => 'required|exists:clientes,id',
        'monto' => 'required|integer',
        'fecha' => 'required|date'
    );
}
