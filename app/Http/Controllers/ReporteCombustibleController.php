<?php
    
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
    
class ReporteCombustibleController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

    }

    public function view_entradas_form()
    {
        return view('reporte_combustible.entradas_form');
    }

    public function get_entradas(Request $request)
    {
        $fecha_desde = $request->get('fecha_desde');
        $fecha_hasta = $request->get('fecha_hasta');

        $sql = "SELECT 
        t1.id,
        CONCAT( DATE_FORMAT( t1.fecha, '%d/%m/%Y' ), ' ', t1.hora ) AS fecha_hora,
        t2.nombre AS combustible,
        t1.cantidad,
        t4.empleado,
        t3.nombre AS proveedor,
        t1.emp_proveedor,
        t1.obs 
        FROM
        combustible_entrada t1
        INNER JOIN combustible t2 ON t1.id_combustible = t2.id
        INNER JOIN proveedor t3 ON t1.id_proveedor = t3.id
        INNER JOIN view_empleados t4 ON t1.id_empleado = t4.id
        WHERE t1.fecha BETWEEN ? AND ?";

        $data = array(
            'fecha_desde' => $fecha_desde,
            'fecha_hasta' => $fecha_hasta,
            'reporte' => DB::select($sql, [$fecha_desde, $fecha_hasta])
        );

        return view('reporte_combustible.entradas_res', $data);
    }

    public function view_salidas_form()
    {
        return view('reporte_combustible.salidas_form');
    }

    public function get_salidas(Request $request)
    {
        $fecha_desde = $request->get('fecha_desde');
        $fecha_hasta = $request->get('fecha_hasta');

        $sql = "SELECT
        t1.id,
        CONCAT( DATE_FORMAT( t1.fecha, '%d/%m/%Y' ), ' ', t1.hora ) AS fecha_hora,
        t2.nombre AS combustible,
        t1.cantidad,
        t4.empleado,
        CONCAT( t3.marca, ' ', t3.modelo, ' [', t3.matricula, ']' ) AS vehiculo,
        t1.resp_vehiculo,
        t1.obs 
        FROM
        combustible_salida t1
        INNER JOIN combustible t2 ON t1.id_combustible = t2.id
        INNER JOIN vehiculo t3 ON t1.id_vehiculo = t3.id
        INNER JOIN view_empleados t4 ON t1.id_empleado = t4.id 
        WHERE t1.fecha BETWEEN ? AND ?";

        $data = array(
            'fecha_desde' => $fecha_desde,
            'fecha_hasta' => $fecha_hasta,
            'reporte' => DB::select($sql, [$fecha_desde, $fecha_hasta])
        );

        return view('reporte_combustible.salidas_res', $data);
    }

}
