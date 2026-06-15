<?php

namespace App\Http\Controllers;

use App\Http\Requests\FailureRequest;
use App\Models\Failure;
use Illuminate\Http\Request;

class FailureController extends Controller
{
    //? Mostrar el listado de Fallas
    public function index() {
        $failures = Failure::all();
        return view('failures.index', compact('failures'));
    }

    //? Mostrar el formulario para crear una nueva Falla
    public function create(){
        $failure = new Failure();
        return view('failures.create', compact('failure'));
    }

    //? Guarda una Falla recien creada en la base de datos
    public function store(FailureRequest $request){
        Failure::create($request->validated());
        return redirect()->route('failures.index')->with('success','Falla Creada');
    }

    //? Muestra una Falla especifica (opcional, pero mejor que este)
    public function show(string $id){
        $failure = Failure::findOrFail($id);
        return view('failures.show', compact('failure'));
    }

    //? Muestra el formulario para editar una Falla existente
    public function edit(string $id){
        $failure = Failure::findOrFail($id);
        return view('failures.edit', compact('failure'));
    }

    //? Actualiza una Falla especifica en la base de datos
    public function update(FailureRequest $request, Failure $failure){
        // $failure = Failure::update($request->validated());
        $failure->update($request->validated());

        return redirect()->route('failures.index')->with('success', 'Falla Actualizada');
    }

    public function destroy(string $id){
        $failure = Failure::findOrFail($id);
        $failure->delete();

        return redirect()->route('failures.index')->with('success', 'Falla Eliminada');
    }
}
