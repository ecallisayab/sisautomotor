<?php
    
namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\TipoMantenimiento;
use App\Models\ProgramaMantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
    
class ProgramaMantenimientoController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:programa_mantenimiento-list|programa_mantenimiento-create|programa_mantenimiento-edit|programa_mantenimiento-delete', ['only' => ['index','show','getList']]);
        $this->middleware('permission:programa_mantenimiento-create', ['only' => ['create','store']]);
        $this->middleware('permission:programa_mantenimiento-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:programa_mantenimiento-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('programa_mantenimiento.index');
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
            'vehiculos' => Vehiculo::select('id', 'matricula', 'marca', 'modelo')->whereNotIn('estado', ['EN_MANTENIMIENTO'])->get()
        );

        return view('programa_mantenimiento.create', $data);
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
            'fecha' => 'required|date',
            'id_tipo' => 'required|numeric',
            'id_vehiculo' => 'required|numeric',
            'obs' => 'required|max:1000|min:1|regex:/(^([a-zA-z_ ]+)(\d+)?$)/u'
        ]);

         // Verifica que el registro no exista en la bd
         $registro = ProgramaMantenimiento::where('id_vehiculo', '=', $request->get('id_vehiculo'))->where('estado', '=', 'EN_MANTENIMIENTO')->get();
         if (!$registro->isEmpty()) {
             return redirect()->route('programa_mantenimiento.index')
                 ->with('warning','No se pudo registrar el mantenimiento programado porque ya existe.');
         }

        // Guarda el registro en la bd
        $model = new ProgramaMantenimiento();
        $model->fecha = $request->get('fecha');
        $model->id_tipo = $request->get('id_tipo');
        $model->id_vehiculo = $request->get('id_vehiculo');
        $model->estado = 'EN_ESPERA';
        $model->obs = strtoupper($request->get('obs'));
        $model->save();
    
        return redirect()->route('programa_mantenimiento.index')
            ->with('success','El mantenimiento programado fue creado correctamente.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$model = ProgramaMantenimiento::find($id);
        $model = DB::table('view_programacion_mantenimientos')->select('*')->where('id', $id)->get();

        $data = array(
            'programacion_mantenimiento' => $model
        );

        return view('programa_mantenimiento.show', $data);
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
        $model = ProgramaMantenimiento::find($id);

        $data = array(
            'tipos_mantenimiento' => TipoMantenimiento::select('id', 'nombre')->where('estado', 'ACTIVO')->get(),
            'vehiculos' => Vehiculo::select('id', 'matricula', 'marca', 'modelo')->whereNotIn('estado', ['EN_MANTENIMIENTO'])->get(),
            'programacion_mantenimiento' => $model
        );
        
        return view('programa_mantenimiento.edit', $data);
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
            'fecha' => 'required|date',
            'id_tipo' => 'required|numeric',
            'id_vehiculo' => 'required|numeric',
            'obs' => 'required|max:1000|min:1|regex:/(^([a-zA-z_ ]+)(\d+)?$)/u'
        ]);

        // Verifica que el registro no exista en la bd
        $registro = ProgramaMantenimiento::where('id_vehiculo', $request->get('id_vehiculo'))->where('estado', 'EN_MANTENIMIENTO')->first();
        //print_r($registro);exit;
        $model = ProgramaMantenimiento::find($id);
        if ($registro !== null) {
            if ($registro->id !== $model->id) {
                return redirect()->route('programa_mantenimiento.index')
                    ->with('warning','No se pudo modificar el mantenimiento programado porque ya existe en otro registro.');
            }
        }
    
        //$model = ProgramaMantenimiento::find($id);
        $model = ProgramaMantenimiento::find($id);
        $model->fecha = $request->get('fecha');
        $model->id_tipo = $request->get('id_tipo');
        $model->id_vehiculo = $request->get('id_vehiculo');
        $model->estado = 'EN_ESPERA';
        $model->obs = strtoupper($request->get('obs'));
        $model->save();
    
        return redirect()->route('programa_mantenimiento.index')
            ->with('success','El mantenimiento programado fue modificado correctamente.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ProgramaMantenimiento::find($id);
        $model->estado = 'CANCELADO';
        $model->save();
        //$model->delete();
    
        return redirect()->route('programa_mantenimiento.index')
            ->with('success','El mantenimiento programado fue cancelado correctamente.');
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
            $data = DB::table('view_programacion_mantenimientos')->select('*')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row) use ($user) {
                    $btn = "";
                    if ($user->can('programa_mantenimiento-list')) {
                        $btn .= '<a href="'.route('programa_mantenimiento.show', $row->id).'" class="btn btn-secondary btn-sm" title="Ver" alt="Ver"><i class="fa fa-eye"></i></a>&nbsp;';
                    }
                    if ($user->can('programa_mantenimiento-edit')) {
                        $btn .= '<a href="'.route('programa_mantenimiento.edit', $row->id).'" class="btn btn-primary btn-sm" title="Editar" alt="Editar"><i class="fa fa-edit"></i></a>&nbsp;';
                    }
                    if ($user->can('programa_mantenimiento-delete')) {
                        $btn .= '<form method="POST" action="'.route('programa_mantenimiento.destroy', $row->id).'" style="display: inline;"><input name="_method" type="hidden" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'" /><button class="btn btn-danger btn-sm" type="submit" title="Cancelar" alt="Cancelar"><i class="fa fa-times"></i></button></form>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
