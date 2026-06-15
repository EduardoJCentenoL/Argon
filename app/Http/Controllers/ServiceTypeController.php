<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceTypeRequest;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    //? Mostrar el listado de Tipos de Servicios
    public function index() {
        $service_types = ServiceType::all();
        return view('service_types.index', compact('service_types'));
    }

    //? Mostrar el formulario para crear una nueva Tipo de Servicio
    public function create(){
        $service_type = new ServiceType();
        return view('service_types.create', compact('service_type'));
    }

    //? Guarda una Tipo de Servicio recien creada en la base de datos
    public function store(ServiceTypeRequest $request){
        ServiceType::create($request->validated());
        return redirect()->route('service_types.index')->with('success','Tipo de Servicio Creada');
    }

    //? Muestra una Tipo de Servicio especifica (opcional, pero mejor que este)
    public function show(string $id){
        $service_type = ServiceType::findOrFail($id);
        return view('service_types.show', compact('service_type'));
    }

    //? Muestra el formulario para editar una Tipo de Servicio existente
    public function edit(string $id){
        $service_type = ServiceType::findOrFail($id);
        return view('service_types.edit', compact('service_type'));
    }

    //? Actualiza una Tipo de Servicio especifica en la base de datos
    public function update(ServiceTypeRequest $request, ServiceType $service_type){
        // $service_type = ServiceType::update($request->validated());
        $service_type->update($request->validated());

        return redirect()->route('service_types.index')->with('success', 'Tipo de Servicio Actualizada');
    }

    public function destroy(string $id){
        $service_type = ServiceType::findOrFail($id);
        $service_type->delete();

        return redirect()->route('service_types.index')->with('success', 'Tipo de Servicio Eliminada');
    }
}
