<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       
        $datos['empleados']=empleado::paginate(10);
        return view('empleado.index',$datos);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleado.create');
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

       /* $campos=[
            'nombre'=>'required|string|max:100',
            'apellido'=>'required|string|max:100',
            'correo'=>'required|email',
            'foto'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'foto.required'=>'La foto es requeria'
        ]; */

        $this->validate($request, $campos, $mensaje);

         //   $datosEmpleados= request()->all();
            $datosEmpleados= request()->except('_token');
           if ($request->hasFile('foto')){
           $datosEmpleados['foto']=$request->file('foto')->store('uploads','public');}
           empleado::insert($datosEmpleados);
         //  return response()->json( $datosEmpleados); mostrar datos
            return redirect('empleado')->with('mensaje','Empleado agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $empleado=empleado::findOrFail($id);
        return view('empleado.edit',compact('empleado'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $campos=[
            'nombre'=>'required|string|max:100',
            'apellido'=>'required|string|max:100',
            'correo'=>'required|email',
            
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            
        ];

        $this->validate($request, $campos, $mensaje);

        if ($request->hasFile('foto')){
            $campos=[  'foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=[  'foto.required'=>'La foto es requeria'];
        }
        $datosEmpleados= request()->except('_token','_method');
              if ($request->hasFile('foto')){
            $empleado=empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->foto);
            $datosEmpleados['foto']=$request->file('foto')->store('uploads','public');}

        empleado::where('id','=',$id)->update($datosEmpleados);
        $empleado=empleado::findOrFail($id);
      // return view('empleado.edit',compact('empleado'));
      return redirect('empleado')->with('mensaje','Empleado Modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $empleado=empleado::findOrFail($id);
        if (Storage::delete('public/'.$empleado->foto)) {
            empleado::destroy($id);
          
        }
        
        return redirect('empleado')->with('mensaje','Empleado eliminado con exito');
    }
}
