<?php
    
namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\SeguimientoMantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
    
class SeguimientoMantenimientoController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:seg_mantenimiento-list|seg_mantenimiento-create|seg_mantenimiento-edit|seg_mantenimiento-delete', ['only' => ['index','show','getList']]);
        $this->middleware('permission:seg_mantenimiento-create', ['only' => ['create','store']]);
        $this->middleware('permission:seg_mantenimiento-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:seg_mantenimiento-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idman)
    {
        $data = array(
            'id_mantenimiento' => $idman
        );

        return view('seguimiento_mantenimiento.index', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idman)
    {
        $data = array(
            'id_mantenimiento' => $idman,
            'empleados' => Empleado::select('id', 'empleado')->get()
        );

        return view('seguimiento_mantenimiento.create', $data);
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
            'id_mantenimiento' => 'required',
            'descrip' => 'required',
            'id_empleado' => 'required'
        ]);

        // Guarda el registro en la bd
        $model = new SeguimientoMantenimiento();
        $model->fecha = $request->get('fecha');
        $model->hora = date('H:i:s');
        $model->id_mantenimiento = $request->get('id_mantenimiento');
        $model->id_empleado = $request->get('id_empleado');
        $model->descrip = strtoupper($request->get('descrip'));
        $model->obs = strtoupper($request->get('obs'));
        $model->save();
    
        return redirect()->route('seguimiento_mantenimiento.index', $request->get('id_mantenimiento'))
            ->with('success','El seguimiento fue creado correctamente.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$model = SeguimientoMantenimiento::find($id);
        $model = DB::table('view_seguimiento_mantenimiento')->select('*')->where('id', $id)->get();

        $data = array(
            'seguimiento' => $model
        );

        return view('seguimiento_mantenimiento.show', $data);
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
        $model = SeguimientoMantenimiento::find($id);

        $data = array(
            'empleados' => Empleado::select('id', 'empleado')->get(),
            'seguimiento' => $model
        );
        
        return view('seguimiento_mantenimiento.edit', $data);
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
            'id_mantenimiento' => 'required',
            'descrip' => 'required',
            'id_empleado' => 'required'
        ]);
    
        //$model = SeguimientoMantenimiento::find($id);
        $model = SeguimientoMantenimiento::find($id);
        $model->fecha = $request->get('fecha');
        $model->hora = date('H:i:s');
        $model->id_mantenimiento = $request->get('id_mantenimiento');
        $model->id_empleado = $request->get('id_empleado');
        $model->descrip = strtoupper($request->get('descrip'));
        $model->obs = strtoupper($request->get('obs'));
        $model->save();
    
        return redirect()->route('seguimiento_mantenimiento.index', $request->get('id_mantenimiento'))
            ->with('success','El seguimiento fue modificado correctamente.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = SeguimientoMantenimiento::find($id);
        $id_mantenimiento = $model->id_mantenimiento;
        $model->delete();
    
        return redirect()->route('seguimiento_mantenimiento.index', $id_mantenimiento)
            ->with('success','El seguimiento fue eliminado correctamente.');
    }

    /**
     * Get list from the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request
     * @return Datatables
     */
    public function getList(Request $request, $idman)
    {
        if ($request->ajax()) {
            $user = auth()->user();
            $data = DB::table('view_seguimiento_mantenimiento')->select('*')->where('id_mantenimiento', $idman)->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row) use ($user) {
                    $btn = "";
                    if ($user->can('seg_mantenimiento-list')) {
                        $btn .= '<a href="'.route('seguimiento_mantenimiento.show', $row->id).'" class="btn btn-secondary btn-sm" title="Ver" alt="Ver"><i class="fa fa-eye"></i></a>&nbsp;';
                    }
                    if ($user->can('seg_mantenimiento-edit')) {
                        $btn .= '<a href="'.route('seguimiento_mantenimiento.edit', $row->id).'" class="btn btn-primary btn-sm" title="Editar" alt="Editar"><i class="fa fa-edit"></i></a>&nbsp;';
                    }
                    /*
                    if ($user->can('seg_mantenimiento-delete')) {
                        $btn .= '<form method="POST" action="'.route('seguimiento_mantenimiento.destroy', $row->id).'" style="display: inline;"><input name="_method" type="hidden" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'" /><button class="btn btn-danger btn-sm" type="submit" title="Eliminar" alt="Eliminar"><i class="fa fa-trash"></i></button></form>';
                    }
                    */
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
