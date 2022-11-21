<?php
    
namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Empleado;
use App\Models\VehiculoEntrada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
    
class VehiculoEntradaController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:vehiculo_entrada-list|vehiculo_entrada-create|vehiculo_entrada-edit|vehiculo_entrada-delete', ['only' => ['index','show','getList']]);
        $this->middleware('permission:vehiculo_entrada-create', ['only' => ['create','store']]);
        $this->middleware('permission:vehiculo_entrada-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:vehiculo_entrada-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vehiculo_entrada.index');
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
        );

        return view('vehiculo_entrada.create', $data);
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
            'fecha' => 'required',
            'id_vehiculo' => 'required',
            'id_empleado' => 'required',
            'resp_vehiculo' => 'required',
        ]);

        // Guarda el registro en la bd
        $model = new VehiculoEntrada();
        $model->fecha = $request->get('fecha');
        $model->hora = date('H:i:s');
        $model->id_vehiculo = $request->get('id_vehiculo');
        $model->id_empleado = $request->get('id_empleado');
        $model->resp_vehiculo = strtoupper($request->get('resp_vehiculo'));
        $model->obs = strtoupper($request->get('obs'));
        $model->save();
    
        return redirect()->route('vehiculo_entrada.index')
            ->with('success','La entrada de vehículo fue creado correctamente.');
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
        $model = DB::table('view_vehiculo_entradas')->select('*')->where('id', $id)->get();

        $data = array(
            'vehiculo_entrada' => $model
        );

        return view('vehiculo_entrada.show', $data);
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
        $model = VehiculoEntrada::find($id);

        $data = array(
            'vehiculos' => Vehiculo::select('id', 'matricula', 'marca', 'modelo')->get(),
            'empleados' => Empleado::select('id', 'empleado')->get(),
            'vehiculo_entrada' => $model
        );
        
        return view('vehiculo_entrada.edit', $data);
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
            'fecha' => 'required',
            'id_vehiculo' => 'required',
            'id_empleado' => 'required',
            'resp_vehiculo' => 'required'
        ]);
    
        $model = VehiculoEntrada::find($id);
        $model->fecha = $request->get('fecha');
        $model->hora = date('H:i:s');
        $model->id_vehiculo = $request->get('id_vehiculo');
        $model->id_empleado = $request->get('id_empleado');
        $model->resp_vehiculo = strtoupper($request->get('resp_vehiculo'));
        $model->obs = strtoupper($request->get('obs'));
        $model->save();
    
        return redirect()->route('vehiculo_entrada.index')
            ->with('success','La entrada de vehículo fue modificado correctamente.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = VehiculoEntrada::find($id);
        $model->delete();
    
        return redirect()->route('vehiculo_entrada.index')
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
            $data = DB::table('view_vehiculo_entradas')->select('*')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row) use ($user) {
                    $btn = "";
                    if ($user->can('vehiculo_entrada-list')) {
                        $btn .= '<a href="'.route('vehiculo_entrada.show', $row->id).'" class="btn btn-secondary btn-sm" title="Ver" alt="Ver"><i class="fa fa-eye"></i></a>&nbsp;';
                    }
                    if ($user->can('vehiculo_entrada-edit')) {
                        $btn .= '<a href="'.route('vehiculo_entrada.edit', $row->id).'" class="btn btn-primary btn-sm" title="Editar" alt="Editar"><i class="fa fa-edit"></i></a>&nbsp;';
                    }
                    if ($user->can('vehiculo_entrada-delete')) {
                        $btn .= '<form method="POST" action="'.route('vehiculo_entrada.destroy', $row->id).'" style="display: inline;"><input name="_method" type="hidden" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'" /><button class="btn btn-danger btn-sm" type="submit" title="Eliminar" alt="Eliminar"><i class="fa fa-trash"></i></button></form>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
