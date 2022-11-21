<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class CombustibleSalida extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $table = 'combustible_salida';

    protected $fillable = [
        'fecha',
        'hora',
        'id_combustible',
        'id_vehiculo',
        'id_empleado',
        'cantidad',
        'resp_vehiculo',
        'obs'
    ];
}