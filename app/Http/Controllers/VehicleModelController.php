<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleModelRequest;
use App\Models\Brand;
use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    public function index(){
        $vehicle_models = VehicleModel::with('brand')->get();/*? uso solamente brand porque son tablas poco complejas
         y el limitar a brand.name no tiene sentido en este caso */
        return view('vehicle_models.index', compact('vehicle_models'));
    }

    public function create(){
        $vehicle_model = new VehicleModel();
        // Inyeccion del catalogo para el formulario
        $brands = Brand::all();
        return view('vehicle_models.create', compact('vehicle_model', 'brands'));
    }

    public function store(VehicleModelRequest $request){
        VehicleModel::create($request->validated());
        return redirect()->route('vehicle_models.index')->with('success', 'Modelo Creado');
    }

    public function show(string $id){
        //? Busqueda Unitaria de FK
        $vehicle_model = VehicleModel::with('brand')->findOrFail($id);
        return view('vehicle_models.show', compact('vehicle_model'));
    }

    public function edit(string $id){
        $vehicle_model = VehicleModel::findOrFail($id);
        //? Reinyeccion del catalogo al editar
        $brands = Brand::all();
        return view('vehicle_models.edit', compact('vehicle_model', 'brands'));
    }

    public function update(VehicleModelRequest $request, VehicleModel $vehicle_model){
        $vehicle_model->update($request->validated());
        return redirect()->route('vehicle_models.index')->with('success', 'Modelo Actualizado');
    }

    public function destroy(string $id){
        $vehicle_model = VehicleModel::findOrFail($id);
        $vehicle_model->delete();
        return redirect()->route('vehicle_models.index')->with('success', 'Modelo Eliminado');
    }

}
