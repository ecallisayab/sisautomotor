<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class VehiculoSalida extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $table = 'vehiculo_salida';

    protected $fillable = [
        'fecha',
        'hora',
        'id_vehiculo',
        'id_empleado',
        'id_proyecto',
        'resp_vehiculo',
        'obs'
    ];
}