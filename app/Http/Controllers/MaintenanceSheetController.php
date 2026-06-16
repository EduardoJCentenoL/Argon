<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaintenanceSheetRequest;
use App\Models\Employee;
use App\Models\Failure;
use App\Models\MaintenanceSheet;
use App\Models\ServiceType;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class MaintenanceSheetController extends Controller
{
    public function index(){
        $maintenance_sheets = MaintenanceSheet::with(['vehicle', 'employee', 'service_type', 'failure'])->get();/*? uso solamente el nombre de la tabla porque son tablas poco complejas
         y el limitar a role.name no tiene sentido en este caso */
        return view('maintenance_sheets.index', compact('maintenance_sheets'));
    }

    public function create(){
        $maintenance_sheet = new MaintenanceSheet();
        // Carga de sus FK
        $vehicles = Vehicle::all();
        $employes = Employee::all();
        $service_types = ServiceType::all();
        $failures = Failure::all();

        return view('maintenance_sheets.create', compact('maintenance_sheet', 'vehicles' ,'employes', 'service_types', 'failures'));
    }

    public function store(MaintenanceSheetRequest $request){
        MaintenanceSheet::create($request->validated());
        return redirect()->route('maintenance_sheets.index')->with('success', 'Hoja de Mantenimiento Creada');
    }

    public function show(string $id){
        $maintenance_sheet = MaintenanceSheet::with(['vehicle', 'employee', 'service_type', 'failure'])->findOrFail($id);

        return view('maintenance_sheets.show', compact('maintenance_sheet'));
    }

    public function edit(string $id){
        $maintenance_sheet = MaintenanceSheet::findOrFail($id);
        //? Inyeccion de catálogos para permitir la edición en el formulario
        $vehicles = Vehicle::all();
        $employes = Employee::all();
        $service_types = ServiceType::all();
        $failures = Failure::all();

        return view('maintenance_sheets.edit', compact('maintenance_sheet', 'vehicles', 'employes', 'service_types', 'failures'));
    }

    public function update(MaintenanceSheetRequest $request, MaintenanceSheet $maintenance_sheet){
        $maintenance_sheet->update($request->validated());
        return redirect()->route('maintenance_sheets.index')->with('success', 'Hoja de Mantenimiento Actualizada');
    }

    public function destroy(string $id){
        $maintenance_sheet = MaintenanceSheet::findOrFail($id);
        $maintenance_sheet->delete();
        return redirect()->route('maintenance_sheets.index')->with('success', 'Hoja de Mantenimiento Eliminada');
    }
}
