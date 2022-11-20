<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Permiso extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $table = 'permissions';

    protected $fillable = [
        'name', 'guard_name'
    ];
}