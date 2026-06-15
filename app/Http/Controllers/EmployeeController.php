<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Shift;
use App\Models\Specialty;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        $employees = Employee::with(['specialty', 'role', 'shift'])->get();/*? uso solamente role porque son tablas poco complejas
         y el limitar a role.name no tiene sentido en este caso por mencionar un ejemplo con role */
        return view('employees.index', compact('employees'));
    }

    public function create(){
        $employee = new Employee();
        // Carga de sus FK
        $specialties = Specialty::all();
        $roles = Role::all();
        $shifts = Shift::all();

        return view('employees.create', compact('employee', 'specialties' ,'roles', 'shifts'));
    }

    public function store(EmployeeRequest $request){
        Employee::create($request->validated());
        return redirect()->route('employees.index')->with('success', 'Empleado Creado');
    }

    public function show(string $id){
        $employee = Employee::with(['specialty', 'role', 'shift'])->findOrFail($id);

        return view('employees.show', compact('employee'));
    }

    public function edit(string $id){
        $employee = Employee::findOrFail($id);
        //? Inyeccion de catálogos para permitir la edición en el formulario
        $specialties = Specialty::all();
        $roles = Role::all();
        $shifts = Shift::all();

        return view('employees.edit', compact('employee', 'specialties', 'roles', 'shifts'));
    }

    public function update(EmployeeRequest $request, Employee $employee){
        $employee->update($request->validated());
        return redirect()->route('employees.index')->with('success', 'Empleado Actualizado');
    }

    public function destroy(string $id){
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Empleado Eliminado');
    }
}
