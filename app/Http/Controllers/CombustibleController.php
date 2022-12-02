<?php
    
namespace App\Http\Controllers;

use App\Models\Combustible;
use Illuminate\Http\Request;
use DataTables;
    
class CombustibleController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:combustible-list|combustible-create|combustible-edit|combustible-delete', ['only' => ['index','show','getList']]);
        $this->middleware('permission:combustible-create', ['only' => ['create','store']]);
        $this->middleware('permission:combustible-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:combustible-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('combustible.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('combustible.create');
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
            'nombre' => 'required|max:50|regex:/(^([a-zA-Z_ ]+)(\d+)?$)/u',
            'estado' => 'required|max:20'
        ]);

        // Verifica que el registro no exista en la bd
        $registro = Combustible::where('nombre', '=', $request->get('nombre'))->get();
        if (!$registro->isEmpty()) {
            return redirect()->route('combustible.index')
                ->with('warning','No se pudo registrar el combustible porque ya existe.');
        }

        // Guarda el registro en la bd
        $model = new Combustible();
        $model->nombre = strtoupper($request->get('nombre'));
        $model->estado = $request->get('estado');
        $model->save();
    
        return redirect()->route('combustible.index')
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
        $model = Combustible::find($id);

        $data = array(
            'combustible' => $model
        );

        return view('combustible.show', $data);
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
        $model = Combustible::find($id);

        $data = array(
            'combustible' => $model
        );
        
        return view('combustible.edit', $data);
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
            'nombre' => 'required|max:50|regex:/(^([a-zA-z_ ]+)(\d+)?$)/u',
            'estado' => 'required|max:20'
        ]);

        // Verifica que el registro no exista en la bd
        $registro = Combustible::where('nombre', $request->get('nombre'))->first();
        //print_r($registro);exit;
        $model = Combustible::find($id);
        if ($registro !== null) {
            if ($registro->id !== $model->id) {
                return redirect()->route('combustible.index')
                    ->with('warning','No se pudo modificar el combustible porque ya existe en otro registro.');
            }
        }
    
        //$model = Combustible::find($id);
        $model->nombre = strtoupper($request->get('nombre'));
        $model->estado = $request->get('estado');
        $model->save();
    
        return redirect()->route('combustible.index')
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
        $model = Combustible::find($id);
        $model->estado = 'INACTIVO';
        $model->save();
        //$model->delete();
    
        return redirect()->route('combustible.index')
            ->with('success','El combustible fue desactivado correctamente.');
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
            $data = Combustible::select('id','nombre','estado')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row) use ($user) {
                    $btn = "";
                    if ($user->can('combustible-list')) {
                        $btn .= '<a href="'.route('combustible.show', $row->id).'" class="btn btn-secondary btn-sm" title="Ver" alt="Ver"><i class="fa fa-eye"></i></a>&nbsp;';
                    }
                    if ($user->can('combustible-edit')) {
                        $btn .= '<a href="'.route('combustible.edit', $row->id).'" class="btn btn-primary btn-sm" title="Editar" alt="Editar"><i class="fa fa-edit"></i></a>&nbsp;';
                    }
                    if ($user->can('combustible-delete')) {
                        $btn .= '<form method="POST" action="'.route('combustible.destroy', $row->id).'" style="display: inline;"><input name="_method" type="hidden" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'" /><button class="btn btn-danger btn-sm" type="submit" title="Desactivar" alt="Desactivar"><i class="fa fa-times"></i></button></form>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
