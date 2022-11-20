<?php
    
namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;
use DataTables;
    
class PermisoController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:permiso-list|permiso-create|permiso-edit|permiso-delete', ['only' => ['index','show','getList']]);
        $this->middleware('permission:permiso-create', ['only' => ['create','store']]);
        $this->middleware('permission:permiso-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permiso-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('permiso.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permiso.create');
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
            'name' => 'required'
        ]);

        // Verifica que el registro no exista en la bd
        $registro = Permiso::where('name', '=', $request->get('name'))->get();
        if (!$registro->isEmpty()) {
            return redirect()->route('permiso.index')
                ->with('warning','No se pudo registrar el permiso porque ya existe.');
        }

        // Guarda el registro en la bd
        $model = new Permiso();
        $model->name = strtolower($request->get('name'));
        $model->guard_name = 'web';
        $model->save();
    
        return redirect()->route('permiso.index')
            ->with('success','El permiso fue creado correctamente.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Permiso::find($id);

        $data = array(
            'permiso' => $model
        );

        return view('permiso.show', $data);
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
        $model = Permiso::find($id);

        $data = array(
            'permiso' => $model
        );
        
        return view('permiso.edit', $data);
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
            'name' => 'required'
        ]);

        // Verifica que el registro no exista en la bd
        $registro = Permiso::where('name', $request->get('name'))->first();
        //print_r($registro);exit;
        $model = Permiso::find($id);
        if ($registro !== null) {
            if ($registro->id !== $model->id) {
                return redirect()->route('permiso.index')
                    ->with('warning','No se pudo modificar el permiso porque ya existe en otro registro.');
            }
            
        }
    
        //$model = Permiso::find($id);
        $model->name = strtolower($request->get('name'));
        $model->save();
    
        return redirect()->route('permiso.index')
            ->with('success','El permiso fue modificado correctamente.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Permiso::find($id);
        $model->delete();
    
        return redirect()->route('permiso.index')
            ->with('success','El permiso fue eliminado correctamente.');
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
            $data = Permiso::select('id','name')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row) use ($user) {
                    $btn = "";
                    if ($user->can('permiso-list')) {
                        $btn .= '<a href="'.route('permiso.show', $row->id).'" class="btn btn-secondary btn-sm" title="Ver" alt="Ver"><i class="fa fa-eye"></i></a>&nbsp;';
                    }
                    if ($user->can('permiso-edit')) {
                        $btn .= '<a href="'.route('permiso.edit', $row->id).'" class="btn btn-primary btn-sm" title="Editar" alt="Editar"><i class="fa fa-edit"></i></a>&nbsp;';
                    }
                    if ($user->can('permiso-delete')) {
                        $btn .= '<form method="POST" action="'.route('permiso.destroy', $row->id).'" style="display: inline;"><input name="_method" type="hidden" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'" /><button class="btn btn-danger btn-sm" type="submit" title="Eliminar" alt="Eliminar"><i class="fa fa-trash"></i></button></form>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
