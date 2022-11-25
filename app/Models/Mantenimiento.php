<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Mantenimiento extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $table = 'mantenimiento';

    protected $fillable = [
        'fecha_entrada',
        'hora_entrada',
        'id_tipo',
        'id_vehiculo',
        'diagnostico_entrada',
        'descrip_entrada',
        'obs_entrada',
        'id_empleado_entrada',
        'fecha_salida',
        'hora_salida',
        'descrip_salida',
        'obs_salida',
        'id_empleado_salida',
        'estado'
    ];
}