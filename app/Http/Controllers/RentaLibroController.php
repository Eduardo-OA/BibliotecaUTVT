<?php

namespace App\Http\Controllers;

use App\Models\Libros;
use App\Models\User;
use App\Models\Maquinas;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Prestamolibros; // Asegúrate de importar el modelo Prestamolibros si aún no lo has hecho
// use App\Models\Prestamolibross;


class RentaLibroController extends Controller
{







    // Método para mostrar todos los préstamos de libros
    public function index()
    {

        return redirect()->route('inicio')->with('success', 'Préstamo de libro eliminado exitosamente.');
    }

    // Método para mostrar el formulario de creación de un nuevo préstamo de libro
    public function create()
    {



    }


    public function store(Request $request)
    {
        // Validar la entrada de datos
        $request->validate([
            'libros_id' => 'required',
            'usuario_id' => 'required',
            'fecha_pres' => 'required|date',
            'fecha_devo' => 'required|date',
            'notas' => 'nullable|string',
        ]);

        // Crear un nuevo préstamo de libro
        $prestamo = Prestamolibros::create($request->all());

        // Actualizar el estado del libro a "rentado"
        $libro = Prestamolibros::findOrFail($prestamo->id);
        $libro->status = 'rentado';
        $libro->save();
          $libros = Libros::findOrFail($request->libros_id);
         $libros->cantidad -= 1;
         $libros->save();
        return view('welcome');
        // return redirect()->route('inicio')->with('success', 'Préstamo de libro creado exitosamente.');
    }


    // Método para mostrar los detalles de un préstamo de libro específico
    public function show($id)
    {

        $prestamo = Prestamolibros::findOrFail($id);
        // return view('prestamos.show', compact('prestamo'));
    }

    // Método para mostrar el formulario de edición de un préstamo de libro
    public function edit($id)
    {
        $prestamo = Prestamolibros::findOrFail($id);
        // return view('prestamos.edit', compact('prestamo'));
    }

    // Método para actualizar la información de un préstamo de libro en la base de datos
    public function update(Request $request, $id)
    {
        // Validar la entrada de datos
        $request->validate([
            'libros_id' => 'required',
            'usuario_id' => 'required',
            'fecha_pres' => 'required|date',
            'fecha_devo' => 'required|date',
            'notas' => 'nullable|string',
        ]);

        // Actualizar el préstamo de libro existente
        $prestamo = Prestamolibros::findOrFail($id);
        $prestamo->update($request->all());

        // return redirect()->route('prestamos.index')->with('success', 'Préstamo de libro actualizado exitosamente.');
    }

    // Método para eliminar un préstamo de libro de la base de datos
  public function destroy($id)
{
    $prestamo = Prestamolibros::findOrFail($id);

    // Actualizar el estado del libro devuelto a "disponible"
    // $libro = $prestamo->libro;
    $prestamo->status = 'disponible';
    $prestamo->save();

    // Ahora puedes decidir si quieres mantener el registro de préstamo en la base de datos o eliminarlo.
    // Si deseas mantener el registro, puedes comentar la línea siguiente.
    // $prestamo->delete();

    return redirect()->route('inicio')->with('success', 'Préstamo de libro devuelto exitosamente.');

}

}



