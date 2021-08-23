<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public $rules = array(
        'email' => 'required|unique:clientes|max:255',
        'nombre' => 'required|max:255',
        'apellido' => 'required|max:255',
    );


    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
    protected $fillable = ['nombre', 'apellido', 'email'];
}
