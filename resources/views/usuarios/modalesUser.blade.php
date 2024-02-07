<div class="modal fade" id="altamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Registro de usuarios</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="modal-body row">
					<div class="col-4">
						<div class="form-group">
							<label for="exampleFormControlInput1">Nombre:</label>
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre...">
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="exampleFormControlInput1">Apellido Paterno:</label>
							<input type="text" class="form-control" id="nombre" name="app" placeholder="apellido p...">
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="exampleFormControlInput1">Apellido Materno:</label>
							<input type="text" class="form-control" id="nombre" name="apm" placeholder="apellido m...">
						</div>
					</div>
					<div class="col-12 pt-2">
						<label>Genero:</label>
						<div class="custom-control custom-radio">
							<input type="radio" id="generoF" name="genero" class="custom-control-input" value="F" checked>
							<label class="custom-control-label" for="generoF">Mujer</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" id="generoH" name="genero" class="custom-control-input" value="M">
							<label class="custom-control-label" for="generoH">Hombre</label>
						</div>
					</div>
					<div class="col-12 pt-2">
						<div class="form-group">
							<label for="opciones">Selecciona una opción:</label>
							<select class="form-control" id="opciones" name="rol_id" onchange="mostrarFormulario()">
								@foreach ($roles as $rol)
								<option value="{{ $rol->id }}">{{ $rol->name }}</option>
								@endforeach
							</select>
						</div>

						<div id="formularioAdmin">
							<div class="pt-2">
								<p id="texto_registro">Ingrese datos adicionales para registrar un nuevo administrador.</p>
							</div>
							<div class="form-group">
								<label for="email">Correo electrónico:</label>
								<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
								<small id="emailHelp" class="form-text text-muted">Ingrese el correo del administrador o auxiliar.</small>
							</div>
							<div class="form-group">
								<label for="password">Contraseña</label>
								<input type="password" class="form-control" id="password" name="password">
							</div>
						</div>

						<div id="formularioEstudiante" style="display: none;">
							<div class="pt-2">
								<p>Ingrese datos adicionales para registrar un nuevo estudiante.</p>
							</div>
							<div class="form-group">
								<label for="carrera">Seleccione la carrera del estudiante:</label>
								<select class="form-control" id="carrera" name="carrera">
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
							</div>
							<div class="form-group">
								<label for="matricula">Matricula del estudiante:</label>
								<input type="number" class="form-control" id="matricula" name="matricula" placeholder="222XXXXXX">
							</div>
							<div class="form-group">
								<label for="direccion">Dirección del estudiante:</label>
								<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Calle, colonia, no. postal, etc...">
							</div>
							<div class="form-group">
								<label for="celular">Número de teléfono del estudiante:</label>
								<input type="text" class="form-control" id="celular" name="celular" placeholder="72XXXXXXXX">
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Añadir</button>
				</div>
			</form>
		</div>
	</div>
</div>

@foreach($usuarios as $user)

<!-- Modal Para editar Administradores START -->
@if($user->rol_id == 1 || $user->rol_id == 2)
<div class="modal fade" id="editmodal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar Usuario.</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('usuarios.update', $user->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="modal-body row">
					<div class="col-4">
						<div class="form-group">
							<label for="exampleFormControlInput1">Nombre:</label>
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre..." value="{{ $user->nombre }}">
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="exampleFormControlInput1">Apellido Paterno:</label>
							<input type="text" class="form-control" id="nombre" name="app" placeholder="apellido p..." value="{{ $user->app }}">
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="exampleFormControlInput1">Apellido Materno:</label>
							<input type="text" class="form-control" id="nombre" name="apm" placeholder="apellido m..." value="{{ $user->apm }}">
						</div>
					</div>
					<div class="col-12 pt-2">
						<label>Genero:</label>
						<div class="custom-control custom-radio">
							<input type="radio" id="generoF" name="genero" class="custom-control-input" value="F" {{ $user->genero === 'F' ? 'checked' : '' }}>
							<label class="custom-control-label" for="generoF">Mujer</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" id="generoH" name="genero" class="custom-control-input" value="M" {{ $user->genero === 'M' ? 'checked' : '' }}>
							<label class="custom-control-label" for="generoH">Hombre</label>
						</div>
					</div>
					<div class="col-12 pt-2">
						<fieldset disabled>
							<div class="form-group">
								<label for="opciones">Selecciona una opción:</label>
								<select class="form-control" id="opciones" name="rol_id">
									@foreach ($roles as $rol)
									<option value="{{ $rol->id }}" {{ $user->rol_id == $rol->id ? 'selected' : '' }}>
										{{ $rol->name }}
									</option>
									@endforeach
								</select>
							</div>
						</fieldset>

						<div id="formularioAdmin">
							<div class="pt-2">
								<p id="texto_registro">Ingrese datos adicionales para editar los datos <strong>(Unicamente en caso de ser requerido, de lo contrario, omitir esta sección y proceder con los demás cambios)</strong>.</p>
							</div>
							<div class="form-group">
								<label for="email">Correo electrónico:</label>
								<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{ $user->email }}">
								<small id="emailHelp" class="form-text text-muted">Ingrese el nuevo correo del administrador o auxiliar.</small>
							</div>
							<div class="form-group">
								<label for="password">Contraseña</label>
								<input type="password" class="form-control" id="password" name="password">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Guardar cambios</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal Para editar Administradores END -->

<!-- Modal Para editar Estudiantes START -->
@elseif($user->rol_id == 3)
<div class="modal fade" id="editmodal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar Usuario.</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('usuarios.update', $user->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="modal-body row">
					<div class="col-4">
						<div class="form-group">
							<label for="exampleFormControlInput1">Nombre:</label>
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre..." value="{{ $user->nombre }}">
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="exampleFormControlInput1">Apellido Paterno:</label>
							<input type="text" class="form-control" id="nombre" name="app" placeholder="apellido p..." value="{{ $user->app }}">
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="exampleFormControlInput1">Apellido Materno:</label>
							<input type="text" class="form-control" id="nombre" name="apm" placeholder="apellido m..." value="{{ $user->apm }}">
						</div>
					</div>
					<div class="col-12 pt-2">
						<label>Genero:</label>
						<div class="custom-control custom-radio">
							<input type="radio" id="generoF" name="genero" class="custom-control-input" value="F" {{ $user->genero == 'F' ? 'checked' : '' }}>
							<label class="custom-control-label" for="generoF">Mujer</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" id="generoH" name="genero" class="custom-control-input" value="M" {{ $user->genero == 'M' ? 'checked' : '' }}>
							<label class="custom-control-label" for="generoH">Hombre</label>
						</div>
					</div>
					<div class="col-12 pt-2">
						<fieldset disabled>
							<div class="form-group">
								<label for="opciones">Selecciona una opción:</label>
								<select class="form-control" id="opciones" name="rol_id">
									@foreach ($roles as $rol)
									<option value="{{ $rol->id }}" {{ $user->rol_id == $rol->id ? 'selected' : '' }}>
										{{ $rol->name }}
									</option>
									@endforeach
								</select>
							</div>
						</fieldset>
						<div id="formularioEstudiante">
							<div class="pt-2">
								<p>Ingrese datos adicionales para actualizar al estudiante.</p>
							</div>
							<fieldset disabled>
								<div class="form-group">
									<label for="carrera">Seleccione la carrera del estudiante:</label>
									<select class="form-control" id="carrera">
										<option value="T.S.U Mantenimiento, Área industrial" {{ $user->carrera == 'T.S.U Mantenimiento, Área industrial' ? 'selected' : '' }}>T.S.U Mantenimiento, Área industrial.</option>
										<option value="T.S.U Mecatrónica, Área Sistermas Manufactura Flexible" {{ $user->carrera == 'T.S.U Mecatrónica, Área Sistermas Manufactura Flexible' ? 'selected' : '' }}>T.S.U Mecatrónica, Área Sistermas Manufactura Flexible.</option>
										<option value="T.S.U Tecnologías de la información, Área Desarrollo de Software Multiplataforma" {{ $user->carrera == 'T.S.U Tecnologías de la información, Área Desarrollo de Software Multiplataforma' ? 'selected' : '' }}>T.S.U Tecnologías de la información, Área Desarrollo de Software Multiplataforma.</option>
										<option value="T.S.U Tecnologías de la información, Área infraestructura de Redes Digitales" {{ $user->carrera == 'T.S.U Tecnologías de la información, Área infraestructura de Redes Digitales' ? 'selected' : '' }}>T.S.U Tecnologías de la información, Área infraestructura de Redes Digitales.</option>
										<option value="T.S.U Procesos Industriales, Área Manufactura" {{ $user->carrera == 'T.S.U Procesos Industriales, Área Manufactura' ? 'selected' : '' }}>T.S.U Procesos Industriales, Área Manufactura.</option>
										<option value="T.S.U Química, Área Tecnología Ambiental" {{ $user->carrera == 'T.S.U Química, Área Tecnología Ambiental' ? 'selected' : '' }}>T.S.U Química, Área Tecnología Ambiental.</option>
										<option value="T.S.U Paramédico" {{ $user->carrera == 'T.S.U Paramédico' ? 'selected' : '' }}>T.S.U Paramédico.</option>
										<option value="T.S.U Desarrollo de Negocios, Área Ventas" {{ $user->carrera == 'T.S.U Desarrollo de Negocios, Área Ventas' ? 'selected' : '' }}>T.S.U Desarrollo de Negocios, Área Ventas.</option>
										<option value="T.S.U Desarrollo de Negocios, Área Mercadotecnica" {{ $user->carrera == 'T.S.U Desarrollo de Negocios, Área Mercadotecnica' ? 'selected' : '' }}>T.S.U Desarrollo de Negocios, Área Mercadotecnica.</option>
										<option value="ING. Mantenimiento Industrial" {{ $user->carrera == 'ING. Mantenimiento Industrial' ? 'selected' : '' }}>ING. Mantenimiento Industrial.</option>
										<option value="ING. Mecatrónica" {{ $user->carrera == 'ING. Mecatrónica' ? 'selected' : '' }}>ING. Mecatrónica.</option>
										<option value="ING. Desarrollo y Gestión de Software" {{ $user->carrera == 'ING. Desarrollo y Gestión de Software' ? 'selected' : '' }}>ING. Desarrollo y Gestión de Software.</option>
										<option value="ING. Redes Inteligentes y Ciberseguridad" {{ $user->carrera == 'ING. Redes Inteligentes y Ciberseguridad' ? 'selected' : '' }}>ING. Redes Inteligentes y Ciberseguridad.</option>
										<option value="ING. Sistemas Productivos" {{ $user->carrera == 'ING. Sistemas Productivos' ? 'selected' : '' }}>ING. Sistemas Productivos.</option>
										<option value="ING. Tecnología Ambiental" {{ $user->carrera == 'ING. Tecnología Ambiental' ? 'selected' : '' }}>ING. Tecnología Ambiental.</option>
										<option value="LIC. Protección Civil y Emergencias" {{ $user->carrera == 'LIC. Protección Civil y Emergencias' ? 'selected' : '' }}>LIC. Protección Civil y Emergencias.</option>
										<option value="LIC. Innovación de Negocios y Mercadotecnica" {{ $user->carrera == 'LIC. Innovación de Negocios y Mercadotecnica' ? 'selected' : '' }}>LIC. Innovación de Negocios y Mercadotecnica.</option>
										<option value="LIC. Enfermería" {{ $user->carrera == 'LIC. Enfermería' ? 'selected' : '' }}>LIC. Enfermería.</option>
									</select>
								</div>
							</fieldset>
							<div class="form-group">
								<label for="matricula">Matricula del estudiante:</label>
								<input type="number" class="form-control" id="matricula" name="matricula" placeholder="222XXXXXX" value="{{ $user->matricula }}">
							</div>
							<div class="form-group">
								<label for="direccion">Dirección del estudiante:</label>
								<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Calle, colonia, no. postal, etc..." value="{{ $user->direccion }}">
							</div>
							<div class="form-group">
								<label for="celular">Número de teléfono del estudiante:</label>
								<input type="text" class="form-control" id="celular" name="celular" placeholder="72XXXXXXXX" value="{{ $user->celular }}">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Guardar cambios</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal Para editar Estudiantes START -->

@else
<!-- Modal Para editar casos de nuevo tipo de rol START -->
<div class="modal fade" id="editmodal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar Usuario.</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('usuarios.update', $user->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="modal-body row">
					<div class="col-4">
						<div class="form-group">
							<label for="exampleFormControlInput1">Nombre:</label>
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre...">
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="exampleFormControlInput1">Apellido Paterno:</label>
							<input type="text" class="form-control" id="nombre" name="app" placeholder="apellido p...">
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="exampleFormControlInput1">Apellido Materno:</label>
							<input type="text" class="form-control" id="nombre" name="apm" placeholder="apellido m...">
						</div>
					</div>
					<div class="col-12 pt-2">
						<label>Genero:</label>
						<div class="custom-control custom-radio">
							<input type="radio" id="generoF" name="genero" class="custom-control-input" value="F" {{ $user->genero === 'F' ? 'checked' : '' }}>
							<label class="custom-control-label" for="generoF">Mujer</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" id="generoH" name="genero" class="custom-control-input" value="M" {{ $user->genero === 'M' ? 'checked' : '' }}>
							<label class="custom-control-label" for="generoH">Hombre</label>
						</div>
					</div>
					<div class="col-12 pt-2">
						<fieldset disabled>
							<div class="form-group">
								<label for="opciones">Selecciona una opción:</label>
								<select class="form-control" id="opciones" name="rol_id">
									@foreach ($roles as $rol)
									<option value="{{ $rol->id }}" {{ $user->rol_id == $rol->id ? 'selected' : '' }}>
										{{ $rol->name }}
									</option>
									@endforeach
								</select>
							</div>
						</fieldset>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Guardar cambios</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal Para editar casos de nuevo tipo de rol END -->
@endif

@endforeach

<!-- Modal para Eliminar Datos -->
@foreach($usuarios as $user)
<div class="modal fade" id="deletemodal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Borrar registro de libro</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				¿Estás seguro de que deseas eliminar este usuario?
			</div>
			<form action="{{ route('usuarios.destroy', $user->id) }}" method="POST">
				@csrf
				@method('DELETE')
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endforeach