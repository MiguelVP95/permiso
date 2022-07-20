<?php

namespace App\Http\Controllers;

use App\Models\cargos;
use Illuminate\Http\Request;

class CargosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['cargos']=empleado::paginate(10);
        return view('cargos.index',$datos);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cargos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos=[
            'cargo'=>'required|string|max:100',
                    
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
          
        ];

        $this->validate($request, $campos, $mensaje);

         //   $datosEmpleados= request()->all();
            $datosCargos= request()->except('_token');
            cargos::insert($datosCargos);
         //  return response()->json( $datosEmpleados); mostrar datos
            return redirect('cargos')->with('mensaje','Cargo agregado con exito');






    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(cargos $cargos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cargos=cargos::findOrFail($id);
        return view('cargos.edit',compact('cargos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cargos $cargos)
    {
        $campos=[
            'cargos'=>'required|string|max:100',
           
            
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            
        ];

        $this->validate($request, $campos, $mensaje);

       
        $datosCargos= request()->except('_token','_method');
              if ($request->hasFile('foto')){
            $cargos=cargos::findOrFail($id);
           

        cargos::where('id','=',$id)->update($datosCargos);
        $empleado=empleado::findOrFail($id);
      // return view('empleado.edit',compact('empleado'));
      return redirect('cargos')->with('mensaje','Cargo Modificado');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy(cargos $cargos)
    {
        $cargos=empleado::findOrFail($id);
        if (Storage::delete('public/'.$empleado->foto)) {
            empleado::destroy($id);
          
        }
        
        return redirect('empleado')->with('mensaje','Empleado eliminado con exito');
    }
}
