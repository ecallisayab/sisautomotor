<?php
    
namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Empleado;
use App\Models\Proyecto;
use App\Models\VehiculoSalida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
    
class VehiculoSalidaController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:vehiculo_salida-list|vehiculo_salida-create|vehiculo_salida-edit|vehiculo_salida-delete', ['only' => ['index','show','getList']]);
        $this->middleware('permission:vehiculo_salida-create', ['only' => ['create','store']]);
        $this->middleware('permission:vehiculo_salida-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:vehiculo_salida-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vehiculo_salida.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'vehiculos' => Vehiculo::select('id', 'matricula', 'marca', 'modelo')->get(),
            'empleados' => Empleado::select('id', 'empleado')->get(),
            'proyectos' => Proyecto::select('id', 'proyecto')->get(),
        );

        return view('vehiculo_salida.create', $data);
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
            'id_vehiculo' => 'required|numeric',
            'id_empleado' => 'required|numeric',
            'id_proyecto' => 'required|numeric',
            'resp_vehiculo' => 'required|max:50|min:1|regex:/(^([a-zA-z_ ]+)?$)/u',
        ]);

        // Guarda el registro en la bd
        $model = new VehiculoSalida();
        $model->fecha = $request->get('fecha');
        $model->hora = date('H:i:s');
        $model->id_vehiculo = $request->get('id_vehiculo');
        $model->id_empleado = $request->get('id_empleado');
        $model->id_proyecto = $request->get('id_proyecto');
        $model->resp_vehiculo = strtoupper($request->get('resp_vehiculo'));
        $model->obs = strtoupper($request->get('obs'));
        $model->save();
    
        return redirect()->route('vehiculo_salida.index')
            ->with('success','La salida de vehículo fue creado correctamente.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$model = VehiculoSalida::find($id);
        $model = DB::table('view_vehiculo_salidas')->select('*')->where('id', $id)->get();

        $data = array(
            'vehiculo_salida' => $model
        );

        return view('vehiculo_salida.show', $data);
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
        $model = VehiculoSalida::find($id);

        $data = array(
            'vehiculos' => Vehiculo::select('id', 'matricula', 'marca', 'modelo')->get(),
            'empleados' => Empleado::select('id', 'empleado')->get(),
            'proyectos' => Proyecto::select('id', 'proyecto')->get(),
            'vehiculo_salida' => $model
        );
        
        return view('vehiculo_salida.edit', $data);
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
            'id_vehiculo' => 'required|numeric',
            'id_empleado' => 'required|numeric',
            'id_proyecto' => 'required|numeric',
            'resp_vehiculo' => 'required|max:50|min:1|regex:/(^([a-zA-z_ ]+)?$)/u',
        ]);
    
        $model = VehiculoSalida::find($id);
        $model->fecha = $request->get('fecha');
        $model->hora = date('H:i:s');
        $model->id_vehiculo = $request->get('id_vehiculo');
        $model->id_empleado = $request->get('id_empleado');
        $model->id_proyecto = $request->get('id_proyecto');
        $model->resp_vehiculo = strtoupper($request->get('resp_vehiculo'));
        $model->obs = strtoupper($request->get('obs'));
        $model->save();
    
        return redirect()->route('vehiculo_salida.index')
            ->with('success','La salida de vehículo fue modificado correctamente.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = VehiculoSalida::find($id);
        $model->delete();
    
        return redirect()->route('vehiculo_salida.index')
            ->with('success','La salida de vehículo fue eliminado correctamente.');
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
            $data = DB::table('view_vehiculo_salidas')->select('*')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row) use ($user) {
                    $btn = "";
                    if ($user->can('vehiculo_salida-list')) {
                        $btn .= '<a href="'.route('vehiculo_salida.show', $row->id).'" class="btn btn-secondary btn-sm" title="Ver" alt="Ver"><i class="fa fa-eye"></i></a>&nbsp;';
                    }
                    if ($user->can('vehiculo_salida-edit')) {
                        $btn .= '<a href="'.route('vehiculo_salida.edit', $row->id).'" class="btn btn-primary btn-sm" title="Editar" alt="Editar"><i class="fa fa-edit"></i></a>&nbsp;';
                    }
                    /*
                    if ($user->can('vehiculo_salida-delete')) {
                        $btn .= '<form method="POST" action="'.route('vehiculo_salida.destroy', $row->id).'" style="display: inline;"><input name="_method" type="hidden" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'" /><button class="btn btn-danger btn-sm" type="submit" title="Eliminar" alt="Eliminar"><i class="fa fa-trash"></i></button></form>';
                    }
                    */
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
