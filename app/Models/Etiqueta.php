<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];
    public function productos(){
        return $this->belongsToMany(Producto::class);
    }
    public $rules = array(
        'nombre'=>'required|max:55'
    );
}
