<?php
    
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
    
class ReporteVehiculoController extends Controller
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
        return view('reporte_vehiculo.entradas_form');
    }

    public function get_entradas(Request $request)
    {
        $fecha_desde = $request->get('fecha_desde');
        $fecha_hasta = $request->get('fecha_hasta');

        $sql = "SELECT
        t1.id,
        CONCAT( DATE_FORMAT( t1.fecha, '%d/%m/%Y' ), ' ', t1.hora ) AS fecha_hora,
        CONCAT( t2.marca, ' ', t2.modelo, ' [', t2.matricula, ']' ) AS vehiculo,
        t3.empleado,
        t1.resp_vehiculo,
        t1.obs 
        FROM
        vehiculo_entrada t1
        INNER JOIN vehiculo t2 ON t1.id_vehiculo = t2.id
        INNER JOIN view_empleados t3 ON t1.id_empleado = t3.id
        WHERE t1.fecha BETWEEN ? AND ?";

        $data = array(
            'fecha_desde' => $fecha_desde,
            'fecha_hasta' => $fecha_hasta,
            'reporte' => DB::select($sql, [$fecha_desde, $fecha_hasta])
        );

        return view('reporte_vehiculo.entradas_res', $data);
    }

    public function view_salidas_form()
    {
        return view('reporte_vehiculo.salidas_form');
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

        return view('reporte_vehiculo.salidas_res', $data);
    }

    public function view_consumo_form()
    {
        return view('reporte_vehiculo.consumo_form');
    }

    public function get_consumo(Request $request)
    {
        $fecha_desde = $request->get('fecha_desde');
        $fecha_hasta = $request->get('fecha_hasta');

        $sql = "SELECT t1.nombre AS combustible, COALESCE(t2.cantidad, 0) As cantidad
        FROM combustible t1
        LEFT JOIN (
        SELECT id_combustible, SUM(cantidad) AS cantidad
        FROM combustible_salida
        WHERE fecha BETWEEN ? AND ?
        GROUP BY id_combustible
        ) t2
        ON t1.id=t2.id_combustible";

        $data = array(
            'fecha_desde' => $fecha_desde,
            'fecha_hasta' => $fecha_hasta,
            'reporte' => DB::select($sql, [$fecha_desde, $fecha_hasta])
        );

        return view('reporte_vehiculo.consumo_res', $data);
    }

}
