<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
</head>
<body>
    <form action="/login" method="post">
        @csrf
        Correo:
        <input type="text" name="email" id="email">
        
        Contraseña:
        <input type="password" name="password" id="password">

        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>