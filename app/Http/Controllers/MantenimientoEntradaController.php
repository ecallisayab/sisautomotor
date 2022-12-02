<?php
    
namespace App\Http\Controllers;

use App\Models\TipoMantenimiento;
use App\Models\Vehiculo;
use App\Models\Empleado;
use App\Models\Mantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
    
class MantenimientoEntradaController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:mantenimiento-list|mantenimiento_entrada-create|mantenimiento_entrada-edit|mantenimiento_entrada-delete', ['only' => ['index','show','getList']]);
        $this->middleware('permission:mantenimiento_entrada-create', ['only' => ['create','store']]);
        $this->middleware('permission:mantenimiento_entrada-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:mantenimiento_entrada-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mantenimiento.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'tipos_mantenimiento' => TipoMantenimiento::select('id', 'nombre')->where('estado', 'ACTIVO')->get(),
            'vehiculos' => Vehiculo::select('id', 'marca', 'modelo', 'matricula')->where('estado', 'ACTIVO')->orWhere('estado', 'INACTIVO')->get(),
            'empleados' => Empleado::select('id', 'empleado')->get()
        );

        return view('mantenimiento.create', $data);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'fecha_entrada' => 'required|date',
            'id_tipo' => 'required',
            'id_vehiculo' => 'required|numeric',
            'diagnostico_entrada' => 'required|max:255|min:1|regex:/(^([a-zA-Z_ ]+)(\d+)?$)/u',
            'descrip_entrada' => 'required|max:1000|min:1|regex:/(^([a-zA-Z_ ]+)(\d+)?$)/u',
            'id_empleado_entrada' => 'required|numeric',
            'estado' => 'required|max:50'
        ]);

        // Guarda el registro en la bd
        $model = new Mantenimiento();
        $model->fecha_entrada = $request->get('fecha_entrada');
        $model->hora_entrada = date('H:i:s');
        $model->id_tipo = $request->get('id_tipo');
        $model->id_vehiculo = $request->get('id_vehiculo');
        $model->diagnostico_entrada = strtoupper($request->get('diagnostico_entrada'));
        $model->descrip_entrada = strtoupper($request->get('descrip_entrada'));
        $model->obs_entrada = strtoupper($request->get('obs_entrada'));
        $model->id_empleado_entrada = $request->get('id_empleado_entrada');
        $model->estado = $request->get('estado');
        $model->save();

        $modelVehiculo = Vehiculo::find($request->get('id_vehiculo'));
        $modelVehiculo->estado = 'EN_MANTENIMIENTO';
        $modelVehiculo->save();
    
        return redirect()->route('mantenimiento.index')
            ->with('success','El mantenimiento fue creado correctamente.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$model = Mantenimiento::find($id);
        $model = DB::table('view_mantenimientos')->select('*')->where('id', $id)->get();

        $data = array(
            'mantenimiento' => $model
        );

        return view('mantenimiento.show', $data);
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
            'tipos_mantenimiento' => TipoMantenimiento::select('id', 'nombre')->where('estado', 'ACTIVO')->get(),
            'vehiculos' => Vehiculo::select('id', 'marca', 'modelo', 'matricula')->where('estado', 'ACTIVO')->orWhere('estado', 'INACTIVO')->get(),
            'empleados' => Empleado::select('id', 'empleado')->get(),
            'mantenimiento_entrada' => $model
        );
        
        return view('mantenimiento.edit', $data);
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
            'fecha_entrada' => 'required|date',
            'id_tipo' => 'required',
            'id_vehiculo' => 'required|numeric',
            'diagnostico_entrada' => 'required|max:255|min:1|regex:/(^([a-zA-Z_ ]+)(\d+)?$)/u',
            'descrip_entrada' => 'required|max:1000|min:1|regex:/(^([a-zA-Z_ ]+)(\d+)?$)/u',
            'id_empleado_entrada' => 'required|numeric',
            'estado' => 'required|max:50'
        ]);
    
        //$model = Mantenimiento::find($id);
        $model = Mantenimiento::find($id);
        $model->fecha_entrada = $request->get('fecha_entrada');
        $model->hora_entrada = date('H:i:s');
        $model->id_tipo = $request->get('id_tipo');
        $model->id_vehiculo = $request->get('id_vehiculo');
        $model->diagnostico_entrada = strtoupper($request->get('diagnostico_entrada'));
        $model->descrip_entrada = strtoupper($request->get('descrip_entrada'));
        $model->obs_entrada = strtoupper($request->get('obs_entrada'));
        $model->id_empleado_entrada = $request->get('id_empleado_entrada');
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
        $model = Mantenimiento::find($id);
        //$model->delete();
        $model->estado = 'CANCELADO';
        $model->save();
    
        return redirect()->route('mantenimiento.index')
            ->with('success','El mantenimiento fue cancelado correctamente.');
    }

    /**
     * Get list from the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request
     * @return Datatables
     */
    public function getList(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user();
            $data = DB::table('view_mantenimientos')->select('id', 'tipo_mantenimiento', 'vehiculo', 'diagnostico_entrada', 'fecha_hora_entrada', 'fecha_hora_salida', 'estado')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row) use ($user) {
                    $btn = '<div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                    if ($user->can('mantenimiento-list')) {
                        $btn .= '<a href="'.route('mantenimiento_entrada.show', $row->id).'" class="dropdown-item" title="Ver" alt="Ver"><i class="fa fa-eye"></i>&nbsp;Ver</a>';
                    }
                    if ($user->can('mantenimiento_entrada-edit')) {
                        $btn .= '<a href="'.route('mantenimiento_entrada.edit', $row->id).'" class="dropdown-item" title="Editar entrada" alt="Editar entrada"><i class="fa fa-edit"></i>&nbsp;Editar entrada</a>';
                        $btn .= '<a href="'.route('mantenimiento_salida.edit', $row->id).'" class="dropdown-item" title="Editar salida" alt="Editar salida"><i class="fa fa-edit"></i>&nbsp;Editar salida</a>';
                    }
                    if ($user->can('mantenimiento_entrada-delete')) {
                        $btn .= '<form method="POST" action="'.route('mantenimiento_entrada.destroy', $row->id).'" style="display: inline;"><input name="_method" type="hidden" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'" /><button class="dropdown-item" type="submit" title="Cancelar" alt="Cancelar"><i class="fa fa-times"></i>&nbsp;Cancelar</button></form>';
                    }
                    if ($user->can('seg_mantenimiento-list')) {
                        $btn .= '<a href="'.route('seguimiento_mantenimiento.index', $row->id).'" class="dropdown-item" title="Seguimiento" alt="Seguimiento"><i class="fa fa-list"></i>&nbsp;Seguimiento</a>';
                    }
                    $btn .= '</div></div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
