<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class CombustibleEntrada extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $table = 'combustible_entrada';

    protected $fillable = [
        'fecha',
        'hora',
        'id_combustible',
        'id_proveedor',
        'id_empleado',
        'cantidad',
        'emp_proveedor',
        'obs'
    ];
}