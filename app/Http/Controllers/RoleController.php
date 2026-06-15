<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //? Mostrar el listado de Roles
    public function index() {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    //? Mostrar el formulario para crear una nueva Rol
    public function create(){
        $role = new Role();
        return view('roles.create', compact('role'));
    }

    //? Guarda una Rol recien creada en la base de datos
    public function store(RoleRequest $request){
        Role::create($request->validated());
        return redirect()->route('roles.index')->with('success','Rol Creada');
    }

    //? Muestra una Rol especifica (opcional, pero mejor que este)
    public function show(string $id){
        $role = Role::findOrFail($id);
        return view('role.show', compact('role'));
    }

    //? Muestra el formulario para editar una Rol existente
    public function edit(string $id){
        $role = Role::findOrFail($id);
        return view('roles.edit', compact('role'));
    }

    //? Actualiza una Rol especifica en la base de datos
    public function update(RoleRequest $request, Role $role){
        // $role = Role::update($request->validated());
        $role->update($request->validated());

        return redirect()->route('roles.index')->with('success', 'Rol Actualizada');
    }

    public function destroy(string $id){
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Rol Eliminada');
    }
}
