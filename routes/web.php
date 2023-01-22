<?php

use App\Http\Controllers\BatteriesController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DroneController;
use App\Http\Controllers\EquipmentsController;
use App\Http\Controllers\KitsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserManagement;
use App\Http\Controllers\ChecklistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\CalendarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardAdminController::class, 'index'])->name('dashboard_admin')->middleware('auth');
Route::get('/map', [DashboardAdminController::class, 'showMap'])->name('map');
Route::get('/plan_mission', [DashboardAdminController::class, 'planMission'])->name('plan_mission');

//AUTH
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'auth']);
Route::post('/logout', [LoginController::class, 'logout']);

// ADMIN USER MANAGEMENT
Route::get('/user', [UserManagement::class, 'index'])->name('user_management');
Route::get('/user/create', [UserManagement::class, 'create']);
Route::post('/user/insert', [UserManagement::class, 'insert']);

// ADMIN PROJECTS
Route::get('/project', [ProjectController::class, 'index'])->name('project')->middleware('admin');
Route::get('/project/detail/{id}', [ProjectController::class, 'detail']);
Route::get('/project/create', [ProjectController::class, 'create']);
Route::post('/project/insert', [ProjectController::class, 'insert']);
Route::get('/project/edit/{id}', [ProjectController::class, 'edit']);
Route::post('/project/update/{id}', [ProjectController::class, 'update']);
Route::get('/project/delete/{id}', [ProjectController::class, 'delete']);

// ADMIN DRONE
Route::get('/inventory/drone', [DroneController::class, 'index'])->name('drone');
Route::get('/inventory/drone/detail/{id}', [DroneController::class, 'detail']);
Route::get('/inventory/drone/create', [DroneController::class, 'create']);
Route::post('/inventory/drone/insert', [DroneController::class, 'insert']);
Route::get('/inventory/drone/edit/{id}', [DroneController::class, 'edit']);
Route::post('/inventory/drone/update/{id}', [DroneController::class, 'update']);
Route::get('/inventory/drone/delete/{id}', [DroneController::class, 'delete']);
Route::get('/inventory/drone/download', [DroneController::class, 'download']);

// ADMIN BATTERIES
Route::get('/inventory/batteries', [BatteriesController::class, 'index'])->name('batteries');
Route::get('/inventory/batteries/detail/{id}', [BatteriesController::class, 'detail']);
Route::get('/inventory/batteries/create', [BatteriesController::class, 'create']);
Route::post('/inventory/batteries/insert', [BatteriesController::class, 'insert']);
Route::get('/inventory/batteries/edit/{id}', [BatteriesController::class, 'edit']);
Route::post('/inventory/batteries/update/{id}', [BatteriesController::class, 'update']);
Route::get('/inventory/batteries/delete/{id}', [BatteriesController::class, 'delete']);
Route::get('/inventory/batteries/download', [BatteriesController::class, 'download']);

// ADMIN EQUIPMENTS
Route::get('/inventory/equipments', [EquipmentsController::class, 'index'])->name('equipments');
Route::get('/inventory/equipments/detail/{id}', [EquipmentsController::class, 'detail']);
Route::get('/inventory/equipments/create', [EquipmentsController::class, 'create']);
Route::post('/inventory/equipments/insert', [EquipmentsController::class, 'insert']);
Route::get('/inventory/equipments/edit/{id}', [EquipmentsController::class, 'edit']);
Route::post('/inventory/equipments/update/{id}', [EquipmentsController::class, 'update']);
Route::get('/inventory/equipments/delete/{id}', [EquipmentsController::class, 'delete']);
Route::get('/inventory/equipments/download', [EquipmentsController::class, 'download']);

// ADMIN KITS
Route::get('/inventory/kits', [KitsController::class, 'index'])->name('kits');
Route::get('/inventory/kits/detail/{id}', [KitsController::class, 'detail']);
Route::get('/inventory/kits/create', [KitsController::class, 'create']);
Route::post('/inventory/kits/insert', [KitsController::class, 'insert']);
Route::get('/inventory/kits/edit/{id}', [KitsController::class, 'edit']);
Route::post('/inventory/kits/update/{id}', [KitsController::class, 'update']);
Route::get('/inventory/kits/delete/{id}', [KitsController::class, 'delete']);
Route::get('/inventory/kits/download', [KitsController::class, 'download']);

// ADMIN FLIGHT
Route::get('/flight', [FlightController::class, 'index'])->name('flight');
Route::get('/flight/download/{id}', [FlightController::class, 'download'])->name('flight.download');

//CALENDAR
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
Route::get('/calendar/download/{id}', [CalendarController::class, 'download'])->name('calendar.download');

Route::get('/checklist', [ChecklistController::class, 'index'])->name('checklist');
Route::get('/checklist/create/{id}', [ChecklistController::class, 'create']);
Route::post('/checklist/insert/{id}', [ChecklistController::class, 'insert']);
