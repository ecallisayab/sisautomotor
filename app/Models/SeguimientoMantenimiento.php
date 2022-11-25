<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class SeguimientoMantenimiento extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $table = 'seguimiento';

    protected $fillable = [
        'id_mantenimiento',
        'fecha',
        'hora',
        'descrip',
        'id_empleado',
        'obs'
    ];
}