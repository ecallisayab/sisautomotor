<?php
    
namespace App\Http\Controllers;

use App\Models\Repuesto;
use Illuminate\Http\Request;
use DataTables;
    
class RepuestoController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:repuesto-list|repuesto-create|repuesto-edit|repuesto-delete', ['only' => ['index','show','getList']]);
        $this->middleware('permission:repuesto-create', ['only' => ['create','store']]);
        $this->middleware('permission:repuesto-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:repuesto-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('repuesto.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('repuesto.create');
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
            'nombre' => 'required',
            'descrip' => 'required',
            'obs' => '',
            'estado' => 'required',
        ]);

        // Verifica que el registro no exista en la bd
        $registro = Repuesto::where('nombre', '=', $request->get('nombre'))->get();
        if (!$registro->isEmpty()) {
            return redirect()->route('repuesto.index')
                ->with('warning','No se pudo registrar el repuesto porque ya existe.');
        }

        // Guarda el registro en la bd
        $model = new Repuesto();
        $model->nombre = strtoupper($request->get('nombre'));
        $model->descrip = strtoupper($request->get('descrip'));
        $model->obs = strtoupper($request->get('obs'));
        $model->estado = $request->get('estado');
        $model->save();
    
        return redirect()->route('repuesto.index')
            ->with('success','El repuesto fue creado correctamente.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Repuesto::find($id);

        $data = array(
            'repuesto' => $model
        );

        return view('repuesto.show', $data);
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
        $model = Repuesto::find($id);

        $data = array(
            'repuesto' => $model
        );
        
        return view('repuesto.edit', $data);
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
            'nombre' => 'required',
            'descrip' => 'required',
            'obs' => '',
            'estado' => 'required',
        ]);

        // Verifica que el registro no exista en la bd
        $registro = Repuesto::where('nombre', $request->get('nombre'))->first();
        //print_r($registro);exit;
        $model = Repuesto::find($id);
        if ($registro !== null) {
            if ($registro->id !== $model->id) {
                return redirect()->route('repuesto.index')
                    ->with('warning','No se pudo modificar el repuesto porque ya existe en otro registro.');
            }
            
        }
    
        //$model = Repuesto::find($id);
        $model->nombre = strtoupper($request->get('nombre'));
        $model->descrip = strtoupper($request->get('descrip'));
        $model->obs = strtoupper($request->get('obs'));
        $model->estado = $request->get('estado');
        $model->save();
    
        return redirect()->route('repuesto.index')
            ->with('success','El repuesto fue modificado correctamente.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Repuesto::find($id);
        $model->delete();
    
        return redirect()->route('repuesto.index')
            ->with('success','El repuesto fue eliminado correctamente.');
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
            $data = Repuesto::select('id','nombre','descrip','obs','estado')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row) use ($user) {
                    $btn = "";
                    if ($user->can('repuesto-list')) {
                        $btn .= '<a href="'.route('repuesto.show', $row->id).'" class="btn btn-secondary btn-sm" title="Ver" alt="Ver"><i class="fa fa-eye"></i></a>&nbsp;';
                    }
                    if ($user->can('repuesto-edit')) {
                        $btn .= '<a href="'.route('repuesto.edit', $row->id).'" class="btn btn-primary btn-sm" title="Editar" alt="Editar"><i class="fa fa-edit"></i></a>&nbsp;';
                    }
                    if ($user->can('repuesto-delete')) {
                        $btn .= '<form method="POST" action="'.route('repuesto.destroy', $row->id).'" style="display: inline;"><input name="_method" type="hidden" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'" /><button class="btn btn-danger btn-sm" type="submit" title="Eliminar" alt="Eliminar"><i class="fa fa-trash"></i></button></form>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
