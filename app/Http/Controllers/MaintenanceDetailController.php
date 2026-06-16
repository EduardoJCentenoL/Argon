<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaintenanceDetailRequest;
use App\Models\MaintenanceDetail;
use App\Models\MaintenanceSheet;
use App\Models\SparePart;
use Illuminate\Http\Request;

class MaintenanceDetailController extends Controller
{
    public function index(){
        $maintenance_details = MaintenanceDetail::with(['sparePart', 'maintenanceSheet'])->get();/*? uso solamente sparePart porque son tablas poco complejas
         y el limitar a sparePart.name no tiene sentido en este caso por mencionar un ejemplo con sparePart */
        return view('maintenance_details.index', compact('maintenance_details'));
    }

    public function create(){
        $maintenance_detail = new MaintenanceDetail();
        // Carga de Piezas de repuesto y Hojas de Repuesto
        $spare_parts = SparePart::all();
        $maintenance_sheets = MaintenanceSheet::all();
        return view('maintenance_details.create', compact('maintenance_detail', 'spare_parts', 'maintenance_sheets'));
    }

    public function store(MaintenanceDetailRequest $request){
        MaintenanceDetail::create($request->validated());
        return redirect()->route('maintenance_details.index')->with('success', 'Detalles de Mantenimiento Creado');
    }

    public function show(string $id){
        $maintenance_detail = MaintenanceDetail::with(['sparePart', 'maintenanceSheet'])->findOrFail($id);
        return view('maintenance_details.show', compact('maintenance_detail'));
    }

    public function edit(string $id){
        $maintenance_detail = MaintenanceDetail::findOrFail($id);
        //? Inyeccion de ambos catálogos para permitir la edición en el formulario
        $spare_parts = SparePart::all();
        $maintenance_sheets = MaintenanceSheet::all();

        return view('maintenance_details.edit', compact('maintenance_detail', 'spare_parts', 'maintenance_sheets'));
    }

    public function update(MaintenanceDetailRequest $request, MaintenanceDetail $maintenance_detail){
        $maintenance_detail->update($request->validated());
        return redirect()->route('maintenance_details.index')->with('success', 'Historial de Servicio Actualizado');
    }

    public function destroy(string $id){
        $maintenance_detail = MaintenanceDetail::findOrFail($id);
        $maintenance_detail->delete();
        return redirect()->route('maintenance_details.index')->with('success', 'Detalles de Mantenimiento Eliminado');
    }
}
