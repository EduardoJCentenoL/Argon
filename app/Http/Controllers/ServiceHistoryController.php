<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceHistoryRequest;
use App\Models\MaintenanceSheet;
use App\Models\ServiceHistory;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ServiceHistoryController extends Controller
{
    public function index(){
        $service_histories = ServiceHistory::with(['vehicle', 'maintenance_sheet'])->get();/*? uso solamente vehicle porque son tablas poco complejas
         y el limitar a vehicle.name no tiene sentido en este caso por mencionar un ejemplo con vehicle */
        return view('service_histories.index', compact('service_histories'));
    }

    public function create(){
        $service_history = new ServiceHistory();
        // Carga de Marca y Proveedores
        $vehicles = Vehicle::all();
        $maintenance_sheets = MaintenanceSheet::all();
        return view('service_histories.create', compact('service_history', 'vehicles', 'maintenance_sheets'));
    }

    public function store(ServiceHistoryRequest $request){
        ServiceHistory::create($request->validated());
        return redirect()->route('service_histories.index')->with('success', 'Historial de Servicios Creado');
    }

    public function show(string $id){
        $service_history = ServiceHistory::with(['vehicle', 'maintenance_sheet'])->findOrFail($id);
        return view('service_histories.show', compact('service_history'));
    }

    public function edit(string $id){
        $service_history = ServiceHistory::findOrFail($id);
        //? Inyeccion de ambos catálogos para permitir la edición en el formulario
        $vehicles = Vehicle::all();
        $maintenance_sheets = MaintenanceSheet::all();

        return view('service_histories.edit', compact('service_history', 'vehicles', 'maintenance_sheets'));
    }

    public function update(ServiceHistoryRequest $request, ServiceHistory $service_history){
        $service_history->update($request->validated());
        return redirect()->route('service_histories.index')->with('success', 'Historial de Servicio Actualizado');
    }

    public function destroy(string $id){
        $service_history = ServiceHistory::findOrFail($id);
        $service_history->delete();
        return redirect()->route('service_histories.index')->with('success', 'Historial de Servicios Eliminado');
    }
}
