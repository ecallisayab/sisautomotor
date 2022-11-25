<?php
    
namespace App\Http\Controllers;

use App\Models\TipoMantenimiento;
use Illuminate\Http\Request;
use DataTables;
    
class TipoMantenimientoController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:tipo_mantenimiento-list|tipo_mantenimiento-create|tipo_mantenimiento-edit|tipo_mantenimiento-delete', ['only' => ['index','show','getList']]);
        $this->middleware('permission:tipo_mantenimiento-create', ['only' => ['create','store']]);
        $this->middleware('permission:tipo_mantenimiento-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:tipo_mantenimiento-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tipo_mantenimiento.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipo_mantenimiento.create');
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
            'estado' => 'required',
        ]);

        // Verifica que el registro no exista en la bd
        $registro = TipoMantenimiento::where('nombre', '=', $request->get('nombre'))->get();
        if (!$registro->isEmpty()) {
            return redirect()->route('tipo_mantenimiento.index')
                ->with('warning','No se pudo registrar el tipo de mantenimiento porque ya existe.');
        }

        // Guarda el registro en la bd
        $model = new TipoMantenimiento();
        $model->nombre = strtoupper($request->get('nombre'));
        $model->estado = $request->get('estado');
        $model->save();
    
        return redirect()->route('tipo_mantenimiento.index')
            ->with('success','El tipo de mantenimiento fue creado correctamente.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = TipoMantenimiento::find($id);

        $data = array(
            'tipo_mantenimiento' => $model
        );

        return view('tipo_mantenimiento.show', $data);
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
        $model = TipoMantenimiento::find($id);

        $data = array(
            'tipo_mantenimiento' => $model
        );
        
        return view('tipo_mantenimiento.edit', $data);
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
            'estado' => 'required',
        ]);

        // Verifica que el registro no exista en la bd
        $registro = TipoMantenimiento::where('nombre', $request->get('nombre'))->first();
        //print_r($registro);exit;
        $model = TipoMantenimiento::find($id);
        if ($registro !== null) {
            if ($registro->id !== $model->id) {
                return redirect()->route('tipo_mantenimiento.index')
                    ->with('warning','No se pudo modificar el tipo de mantenimiento porque ya existe en otro registro.');
            }
            
        }
    
        //$model = TipoMantenimiento::find($id);
        $model->nombre = strtoupper($request->get('nombre'));
        $model->estado = $request->get('estado');
        $model->save();
    
        return redirect()->route('tipo_mantenimiento.index')
            ->with('success','El tipo de mantenimiento fue modificado correctamente.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = TipoMantenimiento::find($id);
        $model->estado = 'INACTIVO';
        $model->save();
        //$model->delete();
    
        return redirect()->route('tipo_mantenimiento.index')
            ->with('success','El tipo de mantenimiento fue desactivado correctamente.');
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
            $data = TipoMantenimiento::select('id','nombre','estado')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row) use ($user) {
                    $btn = "";
                    if ($user->can('tipo_mantenimiento-list')) {
                        $btn .= '<a href="'.route('tipo_mantenimiento.show', $row->id).'" class="btn btn-secondary btn-sm" title="Ver" alt="Ver"><i class="fa fa-eye"></i></a>&nbsp;';
                    }
                    if ($user->can('tipo_mantenimiento-edit')) {
                        $btn .= '<a href="'.route('tipo_mantenimiento.edit', $row->id).'" class="btn btn-primary btn-sm" title="Editar" alt="Editar"><i class="fa fa-edit"></i></a>&nbsp;';
                    }
                    if ($user->can('tipo_mantenimiento-delete')) {
                        $btn .= '<form method="POST" action="'.route('tipo_mantenimiento.destroy', $row->id).'" style="display: inline;"><input name="_method" type="hidden" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'" /><button class="btn btn-danger btn-sm" type="submit" title="Desactivar" alt="Desactivar"><i class="fa fa-times"></i></button></form>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
