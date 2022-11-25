<?php
    
namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Mantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
    
class MantenimientoSalidaController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        //$this->middleware('permission:mantenimiento-list|mantenimiento_entrada-create|mantenimiento_entrada-edit|mantenimiento_entrada-delete', ['only' => ['index','show','getList']]);
        $this->middleware('permission:mantenimiento_entrada-edit', ['only' => ['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $model = Mantenimiento::find($id);

        $data = array(
            'empleados' => Empleado::select('id', 'empleado')->get(),
            'mantenimiento_salida' => $model
        );
        
        return view('mantenimiento.editout', $data);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'fecha_salida' => 'required',
            'descrip_salida' => 'required',
            'id_empleado_salida' => 'required',
            'estado' => 'required'
        ]);
    
        //$model = Mantenimiento::find($id);
        $model = Mantenimiento::find($id);
        $model->fecha_salida = $request->get('fecha_salida');
        $model->hora_salida = date('H:i:s');
        $model->descrip_salida = strtoupper($request->get('descrip_salida'));
        $model->obs_salida = strtoupper($request->get('obs_salida'));
        $model->id_empleado_salida = $request->get('id_empleado_salida');
        $model->estado = $request->get('estado');
        $model->save();
    
        return redirect()->route('mantenimiento.index')
            ->with('success','El mantenimiento fue modificado correctamente.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

}
