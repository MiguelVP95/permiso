
<h1>{{$modo}} empleado</h1>

@if(count($errors)>0)
 <div class="alert alert-danger" role="alert">
 <ul>
    @foreach( $errors->all() as $error)
  <li> {{$error}} </li>
    @endforeach
</ul> 
</div>
 @endif

<div class="form-group">
<label for="Nombre"> Nombre </label>
<input  type="text"  class="form-control" name="nombre"
 value="{{ isset($empleado->nombre)?$empleado->nombre:old('nombre')}}"  id = "nombre">
</div>

<br>
<div class="form-group">
<label for="Apellido"> Apellido </label>
<input  type="text" class="form-control" name="apellido" 
value="{{ isset($empleado->apellido)?$empleado->apellido:old('apellido')}}" id= "apellido">
</div>
<br>

<div class="form-group">
<select class="form-select" aria-label="Default select example">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
</div>
<br>


<div class="form-group">
<label for="Correo"> Correo </label>
<input  type="text" class="form-control" name="correo"
value="{{ isset($empleado->correo)?$empleado->correo:old('correo')}}" id="correo" >
</div>
<br>
<div class="form-group">
<label  for="Foto"></label>
@if (isset($empleado->foto))
<img  img class= "img-thumbnail img-fluid" src="{{asset('storage').'/'.$empleado->foto}}" width="100" alt="" >   
@endif
<input " type="file" class="form-control"name="foto" id= "foto" >
</div>
<br>

<input  class="btn btn-success" type="submit" value ="{{$modo}} datos"> 
<a class="btn btn-primary" href="{{url('empleado/')}}">Regresar</a>
