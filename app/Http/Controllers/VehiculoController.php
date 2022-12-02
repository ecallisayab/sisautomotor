<?php
    
namespace App\Http\Controllers;

//use App\Models\Product;


use App\Models\Proveedor;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use DataTables;
    
class VehiculoController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
            $this->middleware('permission:vehiculo-list|vehiculo-create|vehiculo-edit|vehiculo-delete', ['only' => ['index','show']]);
            $this->middleware('permission:vehiculo-create', ['only' => ['create','store']]);
            $this->middleware('permission:vehiculo-edit', ['only' => ['edit','update']]);
            $this->middleware('permission:vehiculo-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vehiculos.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehiculos.create');
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
            'matricula' => 'required|max:6|min:6|regex:/(^([a-zA-z]){3}(\d){3}?$)/u',
            'marca' => 'required|max:50|min:1|regex:/(^([a-zA-z_ ]+)(\d+)?$)/u',
            'modelo' => 'required|max:50|min:1|regex:/(^([a-zA-z_ ]+)(\d+)?$)/u',
            'color' => 'required|max:50|min:1|regex:/(^([a-zA-z_ ]+)(\d+)?$)/u',
            'tipo' => 'required|max:50|min:1|regex:/(^([a-zA-z_ ]+)(\d+)?$)/u',
            'descrip' => 'required|max:1000|min:1|regex:/(^([a-zA-z_ ]+)(\d+)?$)/u',
            'estado' => 'required|in:ACTIVO,INACTIVO,EN_MANTENIMIENTO',
        ]);

        // Verifica que el registro no exista en la bd
        $registro = Vehiculo::where('matricula', '=', $request->get('matricula'))->get();
        if (!$registro->isEmpty()) {
            return redirect()->route('vehiculo.index')
                ->with('warning','No se pudo registrar el vehículo porque ya existe.');
        }

        // Guarda el registro en la bd
        $model = new Vehiculo();
        $model->matricula = strtoupper($request->get('matricula'));
        $model->marca = strtoupper($request->get('marca'));
        $model->modelo = $request->get('modelo');
        $model->color = $request->get('color');
        $model->tipo = strtoupper($request->get('tipo'));
        $model->descrip = strtoupper($request->get('descrip'));
        $model->estado = $request->get('estado');
        $model->save();
    
        return redirect()->route('vehiculo.index')
            ->with('success','El vehiculo fue creado correctamente.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Vehiculo::find($id);

        $data = array(
            'vehiculo' => $model
        );

        return view('vehiculos.show', $data);
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
        $model = Vehiculo::find($id);

        $data = array(
            'vehiculo' => $model
        );
        
        return view('vehiculos.edit', $data);
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
            'matricula' => 'required|max:6|min:6|regex:/(^([a-zA-z]){3}(\d){3}?$)/u',
            'marca' => 'required|max:50|min:1|regex:/(^([a-zA-z_ ]+)(\d+)?$)/u',
            'modelo' => 'required|max:50|min:1|regex:/(^([a-zA-z_ ]+)(\d+)?$)/u',
            'color' => 'required|max:50|min:1|regex:/(^([a-zA-z_ ]+)(\d+)?$)/u',
            'tipo' => 'required|max:50|min:1|regex:/(^([a-zA-z_ ]+)(\d+)?$)/u',
            'descrip' => 'required|max:1000|min:1|regex:/(^([a-zA-z_ ]+)(\d+)?$)/u',
            'estado' => 'required|in:ACTIVO,INACTIVO,EN_MANTENIMIENTO',
        ]);

        // Verifica que el registro no exista en la bd
        $registro = Vehiculo::where('matricula', $request->get('matricula'))->first();
        //print_r($registro);exit;
        $model = Vehiculo::find($id);
        if ($registro !== null) {
            if ($registro->id !== $model->id) {
                return redirect()->route('vehiculo.index')
                    ->with('warning','No se pudo modificar el vehiculo porque ya existe en otro registro.');
            }
            
        }
    
        //$model = Vehiculo::find($id);
        $model->matricula = strtoupper($request->get('matricula'));
        $model->marca = strtoupper($request->get('marca'));
        $model->modelo = $request->get('modelo');
        $model->color = $request->get('color');
        $model->tipo = strtoupper($request->get('tipo'));
        $model->descrip = strtoupper($request->get('descrip'));
        $model->estado = $request->get('estado');
        $model->save();
    
        return redirect()->route('vehiculo.index')
            ->with('success','El vehiculo fue modificado correctamente.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Vehiculo::find($id);
        $model->estado = 'INACTIVO';
        $model->save();
        //$model->delete();
    
        return redirect()->route('vehiculo.index')
            ->with('success','El vehiculo fue desactivado correctamente.');
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
            $data = Vehiculo::select('id','matricula', 'marca', 'modelo', 'color', 'tipo', 'descrip', 'estado')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row) use ($user) {
                    $btn = "";
                    if ($user->can('vehiculo-list')) {
                        $btn .= '<a href="'.route('vehiculo.show', $row->id).'" class="btn btn-secondary btn-sm" title="Ver" alt="Ver"><i class="fa fa-eye"></i></a>&nbsp;';
                    }
                    if ($user->can('vehiculo-edit')) {
                        $btn .= '<a href="'.route('vehiculo.edit', $row->id).'" class="btn btn-primary btn-sm" title="Editar" alt="Editar"><i class="fa fa-edit"></i></a>&nbsp;';
                    }
                    if ($user->can('vehiculo-delete')) {
                        $btn .= '<form method="POST" action="'.route('vehiculo.destroy', $row->id).'" style="display: inline;"><input name="_method" type="hidden" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'" /><button class="btn btn-danger btn-sm" type="submit" title="Desactivar" alt="Desactivar"><i class="fa fa-times"></i></button></form>';
                    }
                    return $btn;
                    
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
