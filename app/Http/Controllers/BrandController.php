<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrandController extends Controller
{
    //? Mostrar el listado de Marcas
    public function index() {
        $brands = Brand::all();
        return view('brands.index', compact('brands'));
    }

    //? Mostrar el formulario para crear una nueva Marca
    public function create(){
        $brand = new Brand();
        return view('brands.create', compact('brand'));
    }

    //? Guarda una Marca recien creada en la base de datos
    public function store(BrandRequest $request){
        Brand::create($request->validated());
        return redirect()->route('brands.index')->with('succes','Marca Creada');
    }

    //? Muestra una Marca especifica (opcional, pero mejor que este)
    public function show(string $id){
        $brand = Brand::findOrFail($id);
        return view('Brand.show', compact('brand'));
    }

    //? Muestra el formulario para editar una Marca existente
    public function edit(string $id){
        $brand = Brand::findOrFail($id);
        return view('brands.edit', compact('brand'));
    }

    //? Actualiza una Marca especifica en la base de datos
    public function update(BrandRequest $request, Brand $brand){
        // $brand = Brand::update($request->validated());
        $brand->update($request->validated());

        return redirect()->route('brands.index')->with('succes', 'Marca Actualizada');
    }

    public function destroy(string $id){
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('brands.index')->with('succes', 'Marca Eliminada');
    }
}
