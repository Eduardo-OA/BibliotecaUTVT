@extends('layout.layout')


@section('content')
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#altamodal">
	Añadir
</button>
<title>Usuarios</title>
 <div class="table-responsive">
	<table class="table">
		<thead>
		<tr>
			<th>#</th>
			<th>Nombre</th>
			<th>Apellido Paterno</th>
			<th>Apellido Materno</th>
			<th>Cargo</th>
			<th>Carrera</th>
			<th>Matricula</th>
			<th>Direccion</th>
			<th>Celular</th>
			<th>Genero</th>
			<th>E-mail</th>
			<th>Otros</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($usuarios as $user)
		<tr>
			<td>{{$user->id}}</td>
			<td>{{$user->nombre}}</td>
			<td>{{$user->app}}</td>
			<td>{{$user->apm}}</td>
			<td>{{$user->rol_id}}</td>
			<td>{{$user->carrera}}</td>
			<td>{{$user->matricula}}</td>
			<td>{{$user->direccion}}</td>
			<td>{{$user->celular}}</td>
			<td>{{$user->genero}}</td>
			<td>{{$user->mail}}</td>
			<td>
				<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editmodal{{ $user->id }}">
					Editar
				</button>
				
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletemodal{{ $user->id }}">
					Borrar
				</button>				
				
			</td>
			
		</tr>
		@endforeach
	</tbody>
	</table>

	<div class="modal fade" id="altamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Registro de usuarios</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
				 <label> Usuario Nuevo
					<br>
					<input class="form-control" type="text" name="nombre" placeholder="Nombre(s)" row="3">
					<br>
					<input class="form-control" type="text" name="app" placeholder="Apellido Paterno" row="3">
					<br>
					<input class="form-control" type="text" name="apm" placeholder="Apellido Materno" row="3">
					<br>
					<label>
						<input type="radio" name="genero" value="hombre">
						Hombre
					</label>
					<label>
						<input type="radio" name="genero" value="mujer">
						Mujer
					</label>
				 </label>
				<br>
				<label>Selecciona una opción:</label>
				<select id="opciones" name="rol_id" onchange="mostrarFormulario()">
					@foreach ($roles as $rol)
						<option value="{{ $rol->id }}">{{ $rol->name }}</option>
					@endforeach
				</select>

<div id="formularioAdmin" style="display: none;">
	
	<input class="form-control" type="email" name="email" placeholder="Correo Electronio" row="3">
	<input class="form-control" type="password" name="password" placeholder="Contraseña" row="3"> 
</div>

<div id="formularioEstudiante" style="display: none;">
	<select name="carrera">
		<option value="T.S.U Mantenimiento, Área industrial">T.S.U Mantenimiento, Área industrial.</option>
		<option value="T.S.U Mecatrónica, Área Sistermas Manufactura Flexible.">T.S.U Mecatrónica, Área Sistermas Manufactura Flexible.</option>
		<option value="T.S.U Tecnologías de la información, Área Desarrollo de Software Multiplataforma.">T.S.U Tecnologías de la información, Área Desarrollo de Software Multiplataforma.</option>
		<option value="T.S.U Tecnologías de la información, Área infraestructura de Redes Digitales.">T.S.U Tecnologías de la información, Área infraestructura de Redes Digitales.</option>
		<option value="T.S.U Procesos Industriales, Área Manufactura.">T.S.U Procesos Industriales, Área Manufactura.</option>
		<option value="T.S.U Química, Área Tecnología Ambiental.">T.S.U Química, Área Tecnología Ambiental.</option>
		<option value="T.S.U Paramédico.">T.S.U Paramédico.</option>
		<option value="T.S.U Desarrollo de Negocios, Área Ventas.">T.S.U Desarrollo de Negocios, Área Ventas.</option>
		<option value="T.S.U Desarrollo de Negocios, Área Mercadotecnica.">T.S.U Desarrollo de Negocios, Área Mercadotecnica.</option>
		<option value="ING. Mantenimiento Industrial.">ING. Mantenimiento Industrial.</option>
		<option value="ING. Mecatrónica">ING. Mecatrónica.</option>
		<option value="ING. Desarrollo y Gestión de Software.">ING. Desarrollo y Gestión de Software.</option>
		<option value="ING. Redes Inteligentes y Ciberseguridad">ING. Redes Inteligentes y Ciberseguridad.</option>
		<option value="ING. Sistemas Productivos.">ING. Sistemas Productivos.</option>
		<option value="ING. Tecnología Ambiental.">ING. Tecnología Ambiental.</option>
		<option value="LIC. Protección Civil y Emergencias.">LIC. Protección Civil y Emergencias.</option>
		<option value="LIC. Innovación de Negocios y Mercadotecnica.">LIC. Innovación de Negocios y Mercadotecnica.</option>
		<option value="LIC. Enfermería">LIC. Enfermería</option>
	</select>
	<br>
	<input class="form-control" type="number" name="matricula" placeholder="Matricula" row="3">
	<br>
	<input class="form-control" type="text" name="direccion" placeholder="Direccion" row="3">
	<br>
	<input class="form-control" type="text" name="celular" placeholder="Numero de Celular" row="3">
</div>

<div id="formularioDocente" style="display: none;">

	
</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Añadir</button>
				</form>
				</div>
			</div>
		</div>
	</div>
 </div>

 @foreach ($usuarios as $user)
 <!-- Modal Para editar -->
<div class="modal fade" id="editmodal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('usuarios.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label>Usuario a editar:</label>
                    <input class="form-control" type="text" name="nombre" placeholder="Nombre(s)" value="{{ $user->nombre }}" required>
                    <br>
                    <input class="form-control" type="text" name="app" placeholder="Apellido Paterno" value="{{ $user->app }}" required>
                    <br>
                    <input class="form-control" type="text" name="apm" placeholder="Apellido Materno" value="{{ $user->apm }}" required>
                    <br>

                    <label>Género:</label>
                    <label>
                        <input type="radio" name="genero" value="hombre" {{ $user->genero === 'hombre' ? 'checked' : '' }}>
                        Hombre
                    </label>
                    <label>
                        <input type="radio" name="genero" value="mujer" {{ $user->genero === 'mujer' ? 'checked' : '' }}>
                        Mujer
                    </label>

                    <br>

                    <label>Rol:</label>
                    <select id="opciones" name="rol_id" onchange="mostrarFormulario()">
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}" {{ $user->rol_id == $rol->id ? 'selected' : '' }}>
                                {{ $rol->name }}
                            </option>
                        @endforeach
                    </select>

                    <div id="formularioAdmin" style="display: none;">
                        <input class="form-control" type="email" name="email" placeholder="Correo Electrónico" value="{{ $user->email }}">
                        <input class="form-control" type="password" name="password" placeholder="Contraseña">
                    </div>

                    <div id="formularioEstudiante" style="display: none;">
                        <select name="carrera">
                            <option value="T.S.U Mantenimiento, Área industrial">T.S.U Mantenimiento, Área industrial.</option>
		<option value="T.S.U Mecatrónica, Área Sistermas Manufactura Flexible.">T.S.U Mecatrónica, Área Sistermas Manufactura Flexible.</option>
		<option value="T.S.U Tecnologías de la información, Área Desarrollo de Software Multiplataforma.">T.S.U Tecnologías de la información, Área Desarrollo de Software Multiplataforma.</option>
		<option value="T.S.U Tecnologías de la información, Área infraestructura de Redes Digitales.">T.S.U Tecnologías de la información, Área infraestructura de Redes Digitales.</option>
		<option value="T.S.U Procesos Industriales, Área Manufactura.">T.S.U Procesos Industriales, Área Manufactura.</option>
		<option value="T.S.U Química, Área Tecnología Ambiental.">T.S.U Química, Área Tecnología Ambiental.</option>
		<option value="T.S.U Paramédico.">T.S.U Paramédico.</option>
		<option value="T.S.U Desarrollo de Negocios, Área Ventas.">T.S.U Desarrollo de Negocios, Área Ventas.</option>
		<option value="T.S.U Desarrollo de Negocios, Área Mercadotecnica.">T.S.U Desarrollo de Negocios, Área Mercadotecnica.</option>
		<option value="ING. Mantenimiento Industrial.">ING. Mantenimiento Industrial.</option>
		<option value="ING. Mecatrónica">ING. Mecatrónica.</option>
		<option value="ING. Desarrollo y Gestión de Software.">ING. Desarrollo y Gestión de Software.</option>
		<option value="ING. Redes Inteligentes y Ciberseguridad">ING. Redes Inteligentes y Ciberseguridad.</option>
		<option value="ING. Sistemas Productivos.">ING. Sistemas Productivos.</option>
		<option value="ING. Tecnología Ambiental.">ING. Tecnología Ambiental.</option>
		<option value="LIC. Protección Civil y Emergencias.">LIC. Protección Civil y Emergencias.</option>
		<option value="LIC. Innovación de Negocios y Mercadotecnica.">LIC. Innovación de Negocios y Mercadotecnica.</option>
		<option value="LIC. Enfermería">LIC. Enfermería</option>
                        </select>
                        <br>
                        <input class="form-control" type="number" name="matricula" placeholder="Matrícula" value="{{ $user->matricula }}">
                        <br>
                        <input class="form-control" type="text" name="direccion" placeholder="Dirección" value="{{ $user->direccion }}">
                        <br>
                        <input class="form-control" type="text" name="celular" placeholder="Número de Celular" value="{{ $user->celular }}">
                    </div>

                    <div id="formularioDocente" style="display: none;">
                        
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>





 <!-- Modal para Eliminar Datos -->
 <div class="modal fade" id="deletemodal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <p>¿Estás seguro de que deseas eliminar este usuario?</p>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

 <script>
	function mostrarFormulario() {
		var seleccion = document.getElementById("opciones").value;

		
		document.getElementById("formularioAdmin").style.display = "none";
		document.getElementById("formularioEstudiante").style.display = "none";
		document.getElementById("formularioDocente").style.display = "none";
		
		if (seleccion === "1") {
			document.getElementById("formularioAdmin").style.display = "block";
		} else if (seleccion === "2") {
			document.getElementById("formularioEstudiante").style.display = "block";
		} 
		else if (seleccion === "3") {
			document.getElementById("formularioDocente").style.display = "block";
		} 
		
	}
</script>
@endsection