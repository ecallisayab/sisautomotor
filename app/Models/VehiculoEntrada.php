<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class VehiculoEntrada extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $table = 'vehiculo_entrada';

    protected $fillable = [
        'fecha',
        'id_vehiculo',
        'id_empleado',
        'resp_vehiculo',
        'obs'
    ];
}