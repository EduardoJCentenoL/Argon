<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(){
        $vehicles = Vehicle::with(['vehicle_model', 'customer'])->get();/*? uso solamente el nombre de la tabla porque son tablas poco complejas
         y el limitar a role.name no tiene sentido en este caso */
        return view('vehicles.index', compact('vehicles'));
    }

    public function create(){
        $vehicle = new Vehicle();
        // Carga de sus FK
        $vehicle_models = VehicleModel::all();
        $customers = Customer::all();

        return view('vehicles.create', compact('vehicle', 'vehicle_models' ,'customers'));
    }

    public function store(VehicleRequest $request){
        Vehicle::create($request->validated());
        return redirect()->route('vehicles.index')->with('success', 'Vehiculo Creado');
    }

    public function show(string $id){
        $vehicle = Vehicle::with(['vehicle_model', 'customer'])->findOrFail($id);

        return view('vehicles.show', compact('vehicle'));
    }

    public function edit(string $id){
        $vehicle = Vehicle::findOrFail($id);
        //? Inyeccion de catálogos para permitir la edición en el formulario
        $vehicle_models = VehicleModel::all();
        $customers = Customer::all();

        return view('vehicles.edit', compact('vehicle', 'vehicle_models', 'customers'));
    }

    public function update(VehicleRequest $request, Vehicle $vehicle){
        $vehicle->update($request->validated());
        return redirect()->route('vehicles.index')->with('success', 'Vehiculo Actualizado');
    }

    public function destroy(string $id){
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Vehiculo Eliminado');
    }
}
