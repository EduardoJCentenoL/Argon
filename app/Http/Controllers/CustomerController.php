<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //? Mostrar el listado de Clientes
    public function index() {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    //? Mostrar el formulario para crear un nuevo Cliente
    public function create(){
        $customer = new Customer();
        return view('customers.create', compact('customer'));
    }

    //? Guarda un Cliente recien creado en la base de datos
    public function store(CustomerRequest $request){
        Customer::create($request->validated());
        return redirect()->route('customers.index')->with('success','Cliente Creado');
    }

    //? Muestra un Cliente especifico (opcional, pero mejor que este)
    public function show(string $id){
        $customer = Customer::findOrFail($id);
        return view('customers.show', compact('customer'));
    }

    //? Muestra el formulario para editar un Cliente existente
    public function edit(string $id){
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    //? Actualiza un Cliente especifica en la base de datos
    public function update(CustomerRequest $request, Customer $customer){
        // $customer = Customer::update($request->validated());
        $customer->update($request->validated());

        return redirect()->route('customers.index')->with('success', 'Cliente Actualizado');
    }

    public function destroy(string $id){
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Cliente Eliminado');
    }
}
