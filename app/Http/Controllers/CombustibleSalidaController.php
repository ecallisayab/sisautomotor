<?php
    
namespace App\Http\Controllers;

use App\Models\Combustible;
use App\Models\Vehiculo;
use App\Models\Empleado;
use App\Models\CombustibleSalida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
    
class CombustibleSalidaController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:combustible_salida-list|combustible_salida-create|combustible_salida-edit|combustible_salida-delete', ['only' => ['index','show','getList']]);
        $this->middleware('permission:combustible_salida-create', ['only' => ['create','store']]);
        $this->middleware('permission:combustible_salida-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:combustible_salida-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('combustible_salida.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res = DB::table('view_combustible_stock')->select('id_combustible', 'stock')->get();
        $combustibleStock = array();
        foreach($res as $row) {
            $combustibleStock[$row->id_combustible] = (int) $row->stock;
        }

        $data = array(
            'combustibles' => Combustible::select('id', 'nombre')->get(),
            'vehiculos' => Vehiculo::select('id', 'matricula', 'marca', 'modelo')->get(),
            'empleados' => Empleado::select('id', 'empleado')->get(),
            'combustible_stock' => json_encode($combustibleStock)
        );

        return view('combustible_salida.create', $data);
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
            'id_combustible' => 'required|numeric',
            'id_vehiculo' => 'required|numeric',
            'id_empleado' => 'required|numeric',
            'cantidad' => 'required|numeric',
            'resp_vehiculo' => 'required|max:150|regex:/(^(([a-zA-Z ]+)?$))/u',
        ]);

        // Guarda el registro en la bd
        $model = new CombustibleSalida();
        $model->fecha = $request->get('fecha');
        $model->hora = date('H:i:s');
        $model->id_combustible = $request->get('id_combustible');
        $model->id_vehiculo = $request->get('id_vehiculo');
        $model->id_empleado = $request->get('id_empleado');
        $model->cantidad = $request->get('cantidad');
        $model->resp_vehiculo = strtoupper($request->get('resp_vehiculo'));
        $model->obs = strtoupper($request->get('obs'));
        $model->save();
    
        return redirect()->route('combustible_salida.index')
            ->with('success','La salida de combustible fue creado correctamente.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$model = CombustibleSalida::find($id);
        $model = DB::table('view_combustible_salidas')->select('*')->where('id', $id)->get();

        $data = array(
            'combustible_salida' => $model
        );

        return view('combustible_salida.show', $data);
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
        $res = DB::table('view_combustible_stock')->select('id_combustible', 'stock')->get();
        $combustibleStock = array();
        foreach($res as $row) {
            $combustibleStock[$row->id_combustible] = (int) $row->stock;
        }

        $model = CombustibleSalida::find($id);

        $data = array(
            'combustibles' => Combustible::select('id', 'nombre')->get(),
            'vehiculos' => Vehiculo::select('id', 'matricula', 'marca', 'modelo')->get(),
            'empleados' => Empleado::select('id', 'empleado')->get(),
            'combustible_stock' => json_encode($combustibleStock),
            'combustible_salida' => $model
        );
        
        return view('combustible_salida.edit', $data);
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
            'id_combustible' => 'required|numeric',
            'id_vehiculo' => 'required|numeric',
            'id_empleado' => 'required|numeric',
            'cantidad' => 'required|numeric',
            'resp_vehiculo' => 'required|max:150|regex:/(^(([a-zA-Z ]+)?$))/u',
        ]);
    
        //$model = CombustibleSalida::find($id);
        $model = CombustibleSalida::find($id);
        $model->fecha = $request->get('fecha');
        $model->hora = date('H:i:s');
        $model->id_combustible = $request->get('id_combustible');
        $model->id_vehiculo = $request->get('id_vehiculo');
        $model->id_empleado = $request->get('id_empleado');
        $model->cantidad = $request->get('cantidad');
        $model->resp_vehiculo = strtoupper($request->get('resp_vehiculo'));
        $model->obs = strtoupper($request->get('obs'));
        $model->save();
    
        return redirect()->route('combustible_salida.index')
            ->with('success','La salida de combustible fue modificado correctamente.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = CombustibleSalida::find($id);
        $model->delete();
    
        return redirect()->route('combustible_salida.index')
            ->with('success','La salida de combustible fue eliminado correctamente.');
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
            $data = DB::table('view_combustible_salidas')->select('*')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row) use ($user) {
                    $btn = "";
                    if ($user->can('combustible_salida-list')) {
                        $btn .= '<a href="'.route('combustible_salida.show', $row->id).'" class="btn btn-secondary btn-sm" title="Ver" alt="Ver"><i class="fa fa-eye"></i></a>&nbsp;';
                    }
                    if ($user->can('combustible_salida-edit')) {
                        $btn .= '<a href="'.route('combustible_salida.edit', $row->id).'" class="btn btn-primary btn-sm" title="Editar" alt="Editar"><i class="fa fa-edit"></i></a>&nbsp;';
                    }
                    /*
                    if ($user->can('combustible_salida-delete')) {
                        $btn .= '<form method="POST" action="'.route('combustible_salida.destroy', $row->id).'" style="display: inline;"><input name="_method" type="hidden" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'" /><button class="btn btn-danger btn-sm" type="submit" title="Eliminar" alt="Eliminar"><i class="fa fa-trash"></i></button></form>';
                    }
                    */
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
