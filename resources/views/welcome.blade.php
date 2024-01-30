<h1>Inicio</h1>

@auth
    <p>Bienvenido {{ Auth::user()->name.' '.Auth::user()->app.' '.Auth::user()->apm }} estas autenticado!</p>
    <p>
        <a href="/logout">Cerrar Sesión</a>
    </p>
@endauth

@guest
    <p>Para ver el contenido Inicia Sesión</p>
@endguest
