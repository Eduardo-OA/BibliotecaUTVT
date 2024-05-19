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
			<div class="row pb-2">
				<div class="col-12 d-flex align-items-center justify-content-center">
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="pills-estudiante-tab" data-toggle="pill" href="#pills-estudiante" role="tab" aria-controls="pills-estudiante" aria-selected="true">Estudiantes</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="pills-docente-tab" data-toggle="pill" href="#pills-docente" role="tab" aria-controls="pills-docente" aria-selected="false">Docentes</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="pills-biblioteca-tab" data-toggle="pill" href="#pills-biblioteca" role="tab" aria-controls="pills-biblioteca" aria-selected="false">Biblioteca</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="pills-estudiante" role="tabpanel" aria-labelledby="pills-estudiante-tab">
					<div class="row">
						<div class="col">
						</div>
						<div class="col p-4 d-flex justify-content-end">
							<a href="{{ route('carreras.index') }}" class="btn btn-primary">
								Carreras
							</a>
						</div>
					</div>
					<div class="table-responsive">
						<table id="userTable" class="table">
							<thead class="text-center text-primary">
								<th>#</th>
								<th>Nombre</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Genero</th>
								<th>Carrera</th>
								<th>Matricula</th>
								<th>Tipo</th>
								<th>Celular</th>
								<th>Direccion</th>
								<th class="text-center">Acción</th>
								<th class="text-center">Acción</th>
							</thead>
							<tbody>
								@foreach ($estudiantes as $user)
								<tr class="text-center">
									<td class="text-center">{{$user->id}}</td>
									<td>{{$user->nombre}}</td>
									<td>{{$user->app}}</td>
									<td>{{$user->apm}}</td>
									<td>
										@if($user -> genero == 'H')
										Hombre
										@elseif($user->genero == 'M')
										Mujer
										@elseif($user->genero == 'NB')
										No Binario
										@elseif($user->genero == 'MT')
										Mujer Transgénero
										@elseif($user->genero == 'HT')
										Hombre Transgénero
										@elseif($user->genero == 'AG')
										Agénero
										@elseif($user->genero == 'NI')
										Identidad de género no incluida
										@elseif($user->genero == 'PE')
										Prefiero no especificar
										@endif
									</td>
									<td>{{$user->carrera !== null ? $user->carrera : 'Sin dato'}}</td>
									<td>{{$user->matricula !== null ? $user->matricula : 'Sin dato'}}</td>
									<td>@if($user->tipo_estudiante == 'EG') Egresado @elseif($user->tipo_estudiante == 'E') Estudiante @else {{$user->tipo_estudiante}} @endif</td>
									<td>{{$user->celular !== null ? $user->celular : 'Sin dato'}}</td>
									<td>{{$user->direccion !== null ? $user->direccion : 'Sin dato'}}</td>
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
				<div class="tab-pane fade" id="pills-docente" role="tabpanel" aria-labelledby="pills-docente-tab">
					<div class="table-responsive">
						<table id="docenteTable" class="table">
							<thead class="text-center text-primary">
								<th>#</th>
								<th>Nombre</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Genero</th>
								<th>Direccion</th>
								<th>E-mail</th>
								<th class="text-center">Acción</th>
								<th class="text-center">Acción</th>
							</thead>
							<tbody>
								@foreach ($docentes as $user)
								<tr class="text-center">
									<td class="text-center">{{$user->id}}</td>
									<td>{{$user->nombre}}</td>
									<td>{{$user->app}}</td>
									<td>{{$user->apm}}</td>
									<td>
										@if($user -> genero == 'H')
										Hombre
										@elseif($user->genero == 'M')
										Mujer
										@elseif($user->genero == 'NB')
										No Binario
										@elseif($user->genero == 'MT')
										Mujer Transgénero
										@elseif($user->genero == 'HT')
										Hombre Transgénero
										@elseif($user->genero == 'AG')
										Agénero
										@elseif($user->genero == 'NI')
										Identidad de género no incluida
										@elseif($user->genero == 'PE')
										Prefiero no especificar
										@endif
									</td>
									<td>{{$user->direccion !== null ? $user->direccion : 'Sin dato'}}</td>
									<td>{{$user->email !== null ? $user->email : 'Sin dato'}}</td>
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
				<div class="tab-pane fade" id="pills-biblioteca" role="tabpanel" aria-labelledby="pills-biblioteca-tab">
					<div class="table-responsive">
						<table id="bibliotecaTable" class="table">
							<thead class="text-center text-primary">
								<th>#</th>
								<th>Nombre</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Cargo</th>
								<th>Genero</th>
								<th>E-mail</th>
								<th class="text-center">Acción</th>
								<th class="text-center">Acción</th>
							</thead>
							<tbody>
								@foreach ($biblioteca as $user)
								<tr class="text-center">
									<td class="text-center">{{$user->id}}</td>
									<td>{{$user->nombre}}</td>
									<td>{{$user->app}}</td>
									<td>{{$user->apm}}</td>
									<td>
										@if($user->rol_id == 1)
										Administrador
										@elseif($user->rol_id == 2)
										Auxiliar Biblioteca
										@elseif($user->rol_id == 3)
										Estudiante
										@else
										{{$user->rol_id}}
										@endif
									</td>
									<td>
										@if($user -> genero == 'H')
										Hombre
										@elseif($user->genero == 'M')
										Mujer
										@elseif($user->genero == 'NB')
										No Binario
										@elseif($user->genero == 'MT')
										Mujer Transgénero
										@elseif($user->genero == 'HT')
										Hombre Transgénero
										@elseif($user->genero == 'AG')
										Agénero
										@elseif($user->genero == 'NI')
										Identidad de género no incluida
										@elseif($user->genero == 'PE')
										Prefiero no especificar
										@endif
									</td>
									<td>{{$user->email !== null ? $user->email : 'Sin dato'}}</td>
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

		if (seleccion === "1" || seleccion === "2") {
			document.getElementById("formularioAdmin").style.display = "block";
			let textoRegistro = document.querySelector("#texto_registro");
			if (seleccion == "2") {
				textoRegistro.textContent = "Ingrese datos adicionales para registrar un nuevo auxiliar de biblioteca.";
			} else if (seleccion == "1") {
				textoRegistro.textContent = "Ingrese datos adicionales para registrar un nuevo administrador.";
			}
		} else if (seleccion === "3") {
			document.getElementById("formularioEstudiante").style.display = "block";
		} else if (seleccion === "4") {
			document.getElementById("formularioDocente").style.display = "block";
		}

	}
</script>
<script>
	$(document).ready(function() {
		@if(session('success'))
		$.notify({
			message: "<b> Proceso exitoso! </b> {{ session('success') }}!"
		}, {
			type: 'success',
			timer: 8000,
			placement: {
				from: 'top',
				align: 'center'
			}
		});
		@endif
		@if(isset($errors) && count($errors) > 0)
		$.notify({
			message: "<b> Algo salió mal! </b> Asegurese que los datos en el formulario sean correctos"
		}, {
			type: 'danger',
			timer: 8000,
			placement: {
				from: 'top',
				align: 'center'
			}
		});
		@endif
	});
</script>
<script>
	$(document).ready(function() {
		$('#userTable').DataTable({
			language: {
				"decimal": "",
				"emptyTable": "No hay información",
				"info": "Mostrando _START_ - _END_ de _TOTAL_ Entradas",
				"infoEmpty": "Mostrando 0 para 0 de 0 Entradas",
				"infoFiltered": "(Filtrado de _MAX_ total entradas)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "Mostrar _MENU_ Entradas",
				"loadingRecords": "Cargando...",
				"processing": "Procesando...",
				"search": "Buscar:",
				"zeroRecords": "Sin resultados encontrados",
			},
			responsive: true
		});
	});
</script>
<script>
	$(document).ready(function() {
		$('#docenteTable').DataTable({
			responsive: true,
			language: {
				"decimal": "",
				"emptyTable": "No hay información",
				"info": "Mostrando _START_ - _END_ de _TOTAL_ Entradas",
				"infoEmpty": "Mostrando 0 para 0 de 0 Entradas",
				"infoFiltered": "(Filtrado de _MAX_ total entradas)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "Mostrar _MENU_ Entradas",
				"loadingRecords": "Cargando...",
				"processing": "Procesando...",
				"search": "Buscar:",
				"zeroRecords": "Sin resultados encontrados",
			},
		});
	});
</script>
<script>
	$(document).ready(function() {
		$('#bibliotecaTable').DataTable({
			responsive: true,
			language: {
				"decimal": "",
				"emptyTable": "No hay información",
				"info": "Mostrando _START_ - _END_ de _TOTAL_ Entradas",
				"infoEmpty": "Mostrando 0 para 0 de 0 Entradas",
				"infoFiltered": "(Filtrado de _MAX_ total entradas)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "Mostrar _MENU_ Entradas",
				"loadingRecords": "Cargando...",
				"processing": "Procesando...",
				"search": "Buscar:",
				"zeroRecords": "Sin resultados encontrados",
			},
		});
	});
</script>
@endsection

@section('modals')
@include('usuarios.modalesUser')
@endsection