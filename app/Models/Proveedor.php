<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Proveedor extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $table = 'proveedor';

    protected $fillable = [
        'nombre',
        'direccion',
        'fono_1',
        'fono_2',
        'correo',
        'descrip',
        'estado'
    ];
}