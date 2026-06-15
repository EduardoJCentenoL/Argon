<?php

namespace App\Http\Controllers;

use App\Http\Requests\SparePartRequest;
use App\Models\Brand;
use App\Models\Provider;
use App\Models\SparePart;
use Illuminate\Http\Request;

class SparePartController extends Controller
{
    public function index(){
        $spare_parts = SparePart::with(['brand', 'provider'])->get();/*? uso solamente brand porque son tablas poco complejas
         y el limitar a brand.name no tiene sentido en este caso por mencionar un ejemplo con brand */
        return view('spare_parts.index', compact('spare_parts'));
    }

    public function create(){
        $spare_part = new SparePart();
        // Carga de Marca y Proveedores
        $brands = Brand::all();
        $providers = Provider::all();
        return view('spare_parts.create', compact('spare_part', 'brands', 'providers'));
    }

    public function store(SparePartRequest $request){
        SparePart::create($request->validated());
        return redirect()->route('spare_parts.index')->with('success', 'Pieza de Repuesto Creado');
    }

    public function show(string $id){
        $spare_part = SparePart::with(['brand', 'provider'])->findOrFail($id);
        return view('spare_parts.show', compact('spare_part'));
    }

    public function edit(string $id){
        $spare_part = SparePart::findOrFail($id);
        //? Inyeccion de ambos catálogos para permitir la edición en el formulario
        $brands = Brand::all();
        $providers = Provider::all();

        return view('spare_parts.edit', compact('spare_part', 'brands', 'providers'));
    }

    public function update(SparePartRequest $request, SparePart $spare_part){
        $spare_part->update($request->validated());
        return redirect()->route('spare_parts.index')->with('success', 'Pieza de Repuesto Actualizada');
    }

    public function destroy(string $id){
        $spare_part = SparePart::findOrFail($id);
        $spare_part->delete();
        return redirect()->route('spare_parts.index')->with('success', 'Pieza de Repuesto Eliminada');
    }
}
