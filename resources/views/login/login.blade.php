<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/sesiones.css') }}">

</head>
<body>
    <div class="container">
        <div class="log">
            <div class="cuervo"></div>
        <form action="/login" method="post">
            @csrf
            @include('layout.components.alert')
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="correo@correo.com" required>
            </div>
              <br>
            <div class="mb-3">
                <label for="email" class="form-label">Contraseña:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="********" required>
            </div>
              <br>
            <center><button class="raise" type="submit" value="Iniciar Sesión">Iniciar Sesion</button></center>
        </form>
        </div>
    </div>
</body>
</html>