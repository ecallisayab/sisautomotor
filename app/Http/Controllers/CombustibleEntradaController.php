<?php
    
namespace App\Http\Controllers;

use App\Models\Combustible;
use App\Models\Proveedor;
use App\Models\Empleado;
use App\Models\CombustibleEntrada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
    
class CombustibleEntradaController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:combustible_entrada-list|combustible_entrada-create|combustible_entrada-edit|combustible_entrada-delete', ['only' => ['index','show','getList']]);
        $this->middleware('permission:combustible_entrada-create', ['only' => ['create','store']]);
        $this->middleware('permission:combustible_entrada-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:combustible_entrada-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('combustible_entrada.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'combustibles' => Combustible::select('id', 'nombre')->get(),
            'proveedores' => Proveedor::select('id', 'nombre')->get(),
            'empleados' => Empleado::select('id', 'empleado')->get()
        );

        return view('combustible_entrada.create', $data);
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
            'fecha' => 'required|max:10|date',
            'id_combustible' => 'required|numeric',
            'id_proveedor' => 'required|numeric',
            'id_empleado' => 'required|numeric',
            'cantidad' => 'required|numeric',
            'emp_proveedor' => 'required|max:150|regex:/(^(([a-zA-Z ]+)?$))/u',
        ]);

        // Guarda el registro en la bd
        $model = new CombustibleEntrada();
        $model->fecha = $request->get('fecha');
        $model->hora = date('H:i:s');
        $model->id_combustible = $request->get('id_combustible');
        $model->id_proveedor = $request->get('id_proveedor');
        $model->id_empleado = $request->get('id_empleado');
        $model->cantidad = $request->get('cantidad');
        $model->emp_proveedor = strtoupper($request->get('emp_proveedor'));
        $model->obs = strtoupper($request->get('obs'));
        $model->save();
    
        return redirect()->route('combustible_entrada.index')
            ->with('success','El combustible fue creado correctamente.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$model = CombustibleEntrada::find($id);
        $model = DB::table('view_combustible_entradas')->select('*')->where('id', $id)->get();

        $data = array(
            'combustible_entrada' => $model
        );

        return view('combustible_entrada.show', $data);
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
        $model = CombustibleEntrada::find($id);

        $data = array(
            'combustibles' => Combustible::select('id', 'nombre')->get(),
            'proveedores' => Proveedor::select('id', 'nombre')->get(),
            'empleados' => Empleado::select('id', 'empleado')->get(),
            'combustible_entrada' => $model
        );
        
        return view('combustible_entrada.edit', $data);
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
            'fecha' => 'required|max:10|date',
            'id_combustible' => 'required|numeric',
            'id_proveedor' => 'required|numeric',
            'id_empleado' => 'required|numeric',
            'cantidad' => 'required|numeric',
            'emp_proveedor' => 'required|max:150|regex:/(^(([a-zA-Z ]+)?$))/u',
        ]);
    
        //$model = CombustibleEntrada::find($id);
        $model = CombustibleEntrada::find($id);
        $model->fecha = $request->get('fecha');
        $model->hora = date('H:i:s');
        $model->id_combustible = $request->get('id_combustible');
        $model->id_proveedor = $request->get('id_proveedor');
        $model->id_empleado = $request->get('id_empleado');
        $model->cantidad = $request->get('cantidad');
        $model->emp_proveedor = strtoupper($request->get('emp_proveedor'));
        $model->obs = strtoupper($request->get('obs'));
        $model->save();
    
        return redirect()->route('combustible_entrada.index')
            ->with('success','El combustible fue modificado correctamente.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = CombustibleEntrada::find($id);
        $model->delete();
    
        return redirect()->route('combustible_entrada.index')
            ->with('success','El combustible fue eliminado correctamente.');
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
            $data = DB::table('view_combustible_entradas')->select('*')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row) use ($user) {
                    $btn = "";
                    if ($user->can('combustible_entrada-list')) {
                        $btn .= '<a href="'.route('combustible_entrada.show', $row->id).'" class="btn btn-secondary btn-sm" title="Ver" alt="Ver"><i class="fa fa-eye"></i></a>&nbsp;';
                    }
                    if ($user->can('combustible_entrada-edit')) {
                        $btn .= '<a href="'.route('combustible_entrada.edit', $row->id).'" class="btn btn-primary btn-sm" title="Editar" alt="Editar"><i class="fa fa-edit"></i></a>&nbsp;';
                    }
                    /*
                    if ($user->can('combustible_entrada-delete')) {
                        $btn .= '<form method="POST" action="'.route('combustible_entrada.destroy', $row->id).'" style="display: inline;"><input name="_method" type="hidden" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'" /><button class="btn btn-danger btn-sm" type="submit" title="Eliminar" alt="Eliminar"><i class="fa fa-trash"></i></button></form>';
                    }
                    */
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
