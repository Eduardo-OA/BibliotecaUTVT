@extends('layout.layout')

@section('content')
<div class="col-md-12">
	<div class="card">
		<div class="card-header row">
			<div class="col">
				<h4 class="card-title px-4"> Usuarios</h4>
				<p class="card-category px-4"> Tabla de usuarios registrados</p>
			</div>
			<div class="col p-4 d-flex justify-content-end">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#altamodal">
					Añadir
				</button>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table">
					<thead class=" text-primary">
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
						<th class="text-center" colspan="2">Acciones</th>
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
							<td>
								@if($user -> genero == 'M')
								Masculino
								@elseif($user->genero == 'F')
								Femenino
								@endif
							</td>
							<td>{{$user->email}}</td>
							<td>
								<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editmodal{{ $user->id }}">
									Editar
								</button>
							</td>
							<td>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletemodal{{ $user->id }}">
									Borrar
								</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script>
	// Selector de la sección en el navbar
	var navbar = document.querySelector('#usuarios');
	navbar.className = "active";

	// Titulo de la paginá
	var titulo = document.querySelector('#titulo');
	titulo.innerHTML = 'Usuarios';
</script>
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
		} else if (seleccion === "3") {
			document.getElementById("formularioDocente").style.display = "block";
		}

	}
</script>
@endsection

@section('modals')
@include('usuarios.modalesUser')
@endsection