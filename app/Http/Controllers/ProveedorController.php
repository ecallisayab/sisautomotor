<?php
    
namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use DataTables;
    
class ProveedorController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:proveedor-list|proveedor-create|proveedor-edit|proveedor-delete', ['only' => ['index','show','getList']]);
        $this->middleware('permission:proveedor-create', ['only' => ['create','store']]);
        $this->middleware('permission:proveedor-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:proveedor-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('proveedor.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedor.create');
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
            'nombre' => 'required|max:150|regex:/(^(([a-zA-Z0-9. ]+)?$))/u',
            'direccion' => 'required|max:300|regex:/(^(([a-zA-Z0-9.,\- ]+)?$))/u',
            'fono_1' => 'required|max:8|regex:/(^((\d){7,8}?$))/u',
            'descrip' => 'required|max:1000|regex:/(^(([a-zA-Z0-9.,\- ]+)?$))/u',
            'estado' => 'required|max:20',
        ]);

        // Verifica que el registro no exista en la bd
        $registro = Proveedor::where('nombre', '=', $request->get('nombre'))->get();
        if (!$registro->isEmpty()) {
            return redirect()->route('proveedor.index')
                ->with('warning','No se pudo registrar el proveedor porque ya existe.');
        }

        // Guarda el registro en la bd
        $model = new Proveedor();
        $model->nombre = strtoupper($request->get('nombre'));
        $model->direccion = strtoupper($request->get('direccion'));
        $model->fono_1 = $request->get('fono_1');
        $model->fono_2 = $request->get('fono_2');
        $model->correo = strtoupper($request->get('correo'));
        $model->descrip = strtoupper($request->get('descrip'));
        $model->estado = $request->get('estado');
        $model->save();
    
        return redirect()->route('proveedor.index')
            ->with('success','El proveedor fue creado correctamente.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Proveedor::find($id);

        $data = array(
            'proveedor' => $model
        );

        return view('proveedor.show', $data);
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
        $model = Proveedor::find($id);

        $data = array(
            'proveedor' => $model
        );
        
        return view('proveedor.edit', $data);
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
            'nombre' => 'required|max:150|regex:/(^(([a-zA-Z0-9. ]+)?$))/u',
            'direccion' => 'required|max:300|regex:/(^(([a-zA-Z0-9.,\- ]+)?$))/u',
            'fono_1' => 'required|max:8|regex:/(^((\d){7,8}?$))/u',
            'descrip' => 'required|max:1000|regex:/(^(([a-zA-Z0-9.,\- ]+)?$))/u',
            'estado' => 'required|max:20',
        ]);

        // Verifica que el registro no exista en la bd
        $registro = Proveedor::where('nombre', $request->get('nombre'))->first();
        //print_r($registro);exit;
        $model = Proveedor::find($id);
        if ($registro !== null) {
            if ($registro->id !== $model->id) {
                return redirect()->route('proveedor.index')
                    ->with('warning','No se pudo modificar el proveedor porque ya existe en otro registro.');
            }
            
        }
    
        //$model = Proveedor::find($id);
        $model->nombre = strtoupper($request->get('nombre'));
        $model->direccion = strtoupper($request->get('direccion'));
        $model->fono_1 = $request->get('fono_1');
        $model->fono_2 = $request->get('fono_2');
        $model->correo = strtoupper($request->get('correo'));
        $model->descrip = strtoupper($request->get('descrip'));
        $model->estado = $request->get('estado');
        $model->save();
    
        return redirect()->route('proveedor.index')
            ->with('success','El proveedor fue modificado correctamente.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Proveedor::find($id);
        $model->estado = 'INACTIVO';
        $model->save();
        //$model->delete();
    
        return redirect()->route('proveedor.index')
            ->with('success','El proveedor fue desactivado correctamente.');
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
            $data = Proveedor::select('id','nombre', 'direccion', 'fono_1', 'fono_2', 'correo', 'descrip', 'estado')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row) use ($user) {
                    $btn = "";
                    if ($user->can('proveedor-list')) {
                        $btn .= '<a href="'.route('proveedor.show', $row->id).'" class="btn btn-secondary btn-sm" title="Ver" alt="Ver"><i class="fa fa-eye"></i></a>&nbsp;';
                    }
                    if ($user->can('proveedor-edit')) {
                        $btn .= '<a href="'.route('proveedor.edit', $row->id).'" class="btn btn-primary btn-sm" title="Editar" alt="Editar"><i class="fa fa-edit"></i></a>&nbsp;';
                    }
                    if ($user->can('proveedor-delete')) {
                        $btn .= '<form method="POST" action="'.route('proveedor.destroy', $row->id).'" style="display: inline;"><input name="_method" type="hidden" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'" /><button class="btn btn-danger btn-sm" type="submit" title="Desactivar" alt="Desactivar"><i class="fa fa-times"></i></button></form>';
                    }
                    return $btn;
                    
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
