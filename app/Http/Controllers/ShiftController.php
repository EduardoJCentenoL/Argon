<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShiftRequest;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    //? Mostrar el listado de Turnos
    public function index() {
        $shifts = Shift::all();
        return view('shifts.index', compact('shifts'));
    }

    //? Mostrar el formulario para crear una nueva Turno
    public function create(){
        $shift = new Shift();
        return view('shifts.create', compact('shift'));
    }

    //? Guarda una Turno recien creada en la base de datos
    public function store(ShiftRequest $request){
        Shift::create($request->validated());
        return redirect()->route('shifts.index')->with('succes','Shift Creada');
    }

    //? Muestra una Turno especifica (opcional, pero mejor que este)
    public function show(string $id){
        $shift = Shift::findOrFail($id);
        return view('Shift.show', compact('shift'));
    }

    //? Muestra el formulario para editar una Turno existente
    public function edit(string $id){
        $shift = Shift::findOrFail($id);
        return view('shifts.edit', compact('shift'));
    }

    //? Actualiza una Turno especifica en la base de datos
    public function update(ShiftRequest $request, Shift $shift){
        // $shift = Shift::update($request->validated());
        $shift->update($request->validated());

        return redirect()->route('shifts.index')->with('succes', 'Turno Actualizada');
    }

    public function destroy(string $id){
        $shift = Shift::findOrFail($id);
        $shift->delete();

        return redirect()->route('shifts.index')->with('succes', 'Turno Eliminada');
    }
}
