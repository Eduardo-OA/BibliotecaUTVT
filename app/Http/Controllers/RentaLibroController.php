<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamolibros; // Asegúrate de importar el modelo Prestamolibros si aún no lo has hecho
use App\Models\Prestamolibross;

class RentaLibroController extends Controller
{
    // Método para mostrar todos los préstamos de libros
    public function index()
    {
        $prestamos = Prestamolibros::all();
        return view('prestamos.index', compact('prestamos'));
    }

    // Método para mostrar el formulario de creación de un nuevo préstamo de libro
    public function create()
    {
        return view('prestamos.create');
    }

    // Método para almacenar un nuevo préstamo de libro en la base de datos
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
        Prestamolibros::create($request->all());

        return redirect()->route('prestamos.index')->with('success', 'Préstamo de libro creado exitosamente.');
    }

    // Método para mostrar los detalles de un préstamo de libro específico
    public function show($id)
    {
        $prestamo = Prestamolibros::findOrFail($id);
        return view('prestamos.show', compact('prestamo'));
    }

    // Método para mostrar el formulario de edición de un préstamo de libro
    public function edit($id)
    {
        $prestamo = Prestamolibros::findOrFail($id);
        return view('prestamos.edit', compact('prestamo'));
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

        return redirect()->route('prestamos.index')->with('success', 'Préstamo de libro actualizado exitosamente.');
    }

    // Método para eliminar un préstamo de libro de la base de datos
    public function destroy($id)
    {
        $prestamo = Prestamolibros::findOrFail($id);
        $prestamo->delete();

        return redirect()->route('prestamos.index')->with('success', 'Préstamo de libro eliminado exitosamente.');
    }
}
