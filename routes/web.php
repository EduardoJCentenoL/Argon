<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\Example\AnimalController;
use App\Http\Controllers\Example\CategoryController;
use App\Http\Controllers\Example\PostController;
use App\Http\Controllers\Example\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CarrerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FailureController;
use App\Http\Controllers\MaintenanceDetailController;
use App\Http\Controllers\MaintenanceSheetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceHistoryController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleModelController;
use App\Livewire\Products\ProductList;
use App\Models\Specialty;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    //? INICIO DE MIS RUTAS
    // Route::prefix('/brands')->group(function (){
    //     Route::get('/index', fn() => view('brands.index'))->name('brands.index');
    // });
    // Reemplazamos la ruta estática que tenías por el recurso completo del CRUD de tu profesor
    // Route::resource('brands', \App\Http\Controllers\BrandController::class); //?Ruta larga en caso de no llamar al Controlador con el use arriba
    Route::resource('brands', BrandController::class);

    //Routes of Roles
    // Route::resource('roles', RoleContro::class);
    Route::resource('roles', RoleController::class);

    //Routes of Shifts
    Route::resource('shifts', ShiftController::class);

    //Routes of Specialties
    Route::resource('specialties', SpecialtyController::class);

    //Routes of ServiceTypes
    Route::resource('service_types', ServiceTypeController::class);

    //Routes of Failures
    Route::resource('failures', FailureController::class);

    //Routes of Providers
    Route::resource('providers', ProviderController::class);

    //Routes of VehicleModels
    Route::resource('vehicle_models', VehicleModelController::class);

    //Routes of Customers
    Route::resource('customers', CustomerController::class);

    //Routes of Employees
    Route::resource('employees', EmployeeController::class);

    //Routes of SpareParts
    Route::resource('spare_parts', SparePartController::class);

    //Routes of Vehicles
    Route::resource('vehicles', VehicleController::class);

    //Routes of MaintenanceSheets
    Route::resource('maintenance_sheets', MaintenanceSheetController::class);

    //Routes of ServiceHistories
    Route::resource('service_histories', ServiceHistoryController::class);

    //Routes of MaintenanceDetails
    Route::resource('maintenance_details', MaintenanceDetailController::class);

    //?FIN DE MIS RUTAS
    //rutas de ejemplo sin controlador con prefijo
    Route::prefix('/ejemplo')->group(function () {
        Route::get('/index', fn() => view('examples.ejemplo.index'))->name('ejemplo.index');
        Route::get('/create', fn() => view('examples.ejemplo.create'))->name('ejemplo.create');
        Route::get('/edit', fn() => view('examples.ejemplo.edit'))->name('ejemplo.edit');
        Route::get('/show', fn() => view('examples.ejemplo.show'))->name('ejemplo.show');
    });

    //rutas con controlador y prefix
    Route::prefix('/categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
    });

    Route::prefix('/posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts.index');
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/', [PostController::class, 'store'])->name('posts.store');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
        Route::get('/{post}', [PostController::class, 'show'])->name('posts.show');
    });

    Route::prefix('/animals')->group(function () {
        Route::get('/', [AnimalController::class, 'index'])->name('animals.index');
        Route::get('/create', [AnimalController::class, 'create'])->name('animals.create');
        Route::post('/', [AnimalController::class, 'store'])->name('animals.store');
        Route::get('/{animal}/edit', [AnimalController::class, 'edit'])->name('animals.edit');
        Route::put('/{animal}', [AnimalController::class, 'update'])->name('animals.update');
        Route::delete('/{animal}', [AnimalController::class, 'destroy'])->name('animals.destroy');
        Route::get('/{animal}', [AnimalController::class, 'show'])->name('animals.show');
    });

    //rutas de posts de tipo resource
    Route::resource('/students', StudentController::class);
    Route::resource('/carrers', CarrerController::class);

    // Route::resource('/categories', CategoryController::class);
    // Route::resource('/animals', AnimalController::class);
});

require __DIR__ . '/auth.php';
