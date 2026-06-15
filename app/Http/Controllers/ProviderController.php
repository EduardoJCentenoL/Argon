<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderRequest;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    //? Mostrar el listado de Proveedores
    public function index() {
        $providers = Provider::all();
        return view('providers.index', compact('providers'));
    }

    //? Mostrar el formulario para crear un nuevo Proveedor
    public function create(){
        $provider = new Provider();
        return view('providers.create', compact('provider'));
    }

    //? Guarda una Proveedor recien creada en la base de datos
    public function store(ProviderRequest $request){
        Provider::create($request->validated());
        return redirect()->route('providers.index')->with('success','Provider Creada');
    }

    //? Muestra una Proveedor especifica (opcional, pero mejor que este)
    public function show(string $id){
        $provider = Provider::findOrFail($id);
        return view('providers.show', compact('provider'));
    }

    //? Muestra el formulario para editar un Proveedor existente
    public function edit(string $id){
        $provider = Provider::findOrFail($id);
        return view('providers.edit', compact('provider'));
    }

    //? Actualiza una Proveedor especifica en la base de datos
    public function update(ProviderRequest $request, Provider $provider){
        // $provider = Provider::update($request->validated());
        $provider->update($request->validated());

        return redirect()->route('providers.index')->with('success', 'Proveedor Actualizado');
    }

    public function destroy(string $id){
        $provider = Provider::findOrFail($id);
        $provider->delete();

        return redirect()->route('providers.index')->with('success', 'Proveedor Eliminado');
    }
}
