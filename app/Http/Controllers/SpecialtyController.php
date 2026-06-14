<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecialtyRequest;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    //? Mostrar el listado de Especialidades
    public function index() {
        $specialties = Specialty::all();
        return view('specialties.index', compact('specialties'));
    }

    //? Mostrar el formulario para crear una nueva Especialidad
    public function create(){
        $specialty = new Specialty();
        return view('specialties.create', compact('specialty'));
    }

    //? Guarda una Especialidad recien creada en la base de datos
    public function store(SpecialtyRequest $request){
        Specialty::create($request->validated());
        return redirect()->route('specialties.index')->with('succes','Especialidad Creada');
    }

    //? Muestra una Especialidad especifica (opcional, pero mejor que este)
    public function show(string $id){
        $specialty = Specialty::findOrFail($id);
        return view('Specialty.show', compact('specialty'));
    }

    //? Muestra el formulario para editar una Especialidad existente
    public function edit(string $id){
        $specialty = Specialty::findOrFail($id);
        return view('specialties.edit', compact('specialty'));
    }

    //? Actualiza una Especialidad especifica en la base de datos
    public function update(SpecialtyRequest $request, Specialty $specialty){
        // $specialty = Specialty::update($request->validated());
        $specialty->update($request->validated());

        return redirect()->route('specialties.index')->with('succes', 'Especialidad Actualizada');
    }

    public function destroy(string $id){
        $specialty = Specialty::findOrFail($id);
        $specialty->delete();

        return redirect()->route('specialties.index')->with('succes', 'Especialidad Eliminada');
    }
}
