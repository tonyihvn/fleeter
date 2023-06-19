<?php

use Illuminate\Support\Facades\Route;
// use App\WebSocketServer;
use App\Events\UpdateCoordinates;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

// HOME
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// staffs
Route::get('staffs', [App\Http\Controllers\HomeController::class, 'staffs'])->name('staffs')->middleware('role:Supervisor,Admin,Super');
Route::get('new-staff', [App\Http\Controllers\HomeController::class, 'newStaff'])->name('new-staff')->middleware('role:Supervisor,Admin,Super');
Route::post('saveStaff', [App\Http\Controllers\HomeController::class, 'saveStaff'])->name('saveStaff')->middleware('role:Staff,Supervisor,Admin,Super');
Route::get('edit-staff/{cid}', [App\Http\Controllers\HomeController::class, 'editStaff'])->name('edit-staff')->middleware('role:Staff,Supervisor,Admin,Super');
Route::get('delete-staff/{cid}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('delete-staff')->middleware('role:Super');
Route::get('drivers', [App\Http\Controllers\HomeController::class, 'drivers'])->name('drivers')->middleware('role:Admin,Super');


// Requests
Route::get('requests', [App\Http\Controllers\RequestsController::class, 'index'])->name('requests')->middleware('role:Supervisor,Admin,Super');
Route::get('new-request', [App\Http\Controllers\RequestsController::class, 'create'])->name('new-request')->middleware('role:Staff,Supervisor,Admin,Super');
Route::post('saveRequest', [App\Http\Controllers\RequestsController::class, 'store'])->name('saveRequest')->middleware('role:Staff,Supervisor,Admin,Super');
Route::post('updateRequest', [App\Http\Controllers\RequestsController::class, 'updateRequest'])->name('updateRequest')->middleware('role:Staff,Supervisor,Admin,Super');

Route::get('edit-request/{rid}', [App\Http\Controllers\RequestsController::class, 'editRequest'])->name('edit-request')->middleware('role:Staff,Supervisor,Admin,Super');
Route::get('approve-request/{rid}', [App\Http\Controllers\RequestsController::class, 'approveRequest'])->name('approve-request')->middleware('role:Admin,Super');
Route::get('disapprove-request/{rid}', [App\Http\Controllers\RequestsController::class, 'disapproveRequest'])->name('disapprove-request')->middleware('role:Supervisor,Admin,Super');
//Route::get('start-trip/{rid}', [App\Http\Controllers\RequestsController::class, 'startTrip'])->name('start-trip')->middleware('role:Driver,Admin,Super');
Route::get('request-persons/{rid}', [App\Http\Controllers\RequestsController::class, 'tripPersons'])->name('request-persons')->middleware('role:Staff,Driver,Admin,Super');

// LIVE MAP
// Route::get('/update-coordinates', function () {
//     $server = app()->make(WebSocketServer::class);
//     $server->broadcast('update-coordinates');
//     return response()->json(['success' => true]);
// });
Route::get('live-tracker/{tripid}', [App\Http\Controllers\TripsController::class, 'liveTracker'])->name('live-tracker')->middleware('role:Staff,Driver,Admin,Super');
Route::post('/update-location', [App\Http\Controllers\TripsController::class, 'updateLocation'])->name('update-location')->middleware('role:Staff,Driver,Supervisor,Admin,Super');
Route::get('/visitors', [App\Http\Controllers\TripsController::class, 'onTrip'])->name('visitors')->middleware('role:Staff,Driver,Admin,Super');

// TRIPS
Route::get('trips', [App\Http\Controllers\TripsController::class, 'index'])->name('trips')->middleware('role:Staff,Driver,Admin,Super');
Route::get('trip/{tripid}', [App\Http\Controllers\TripsController::class, 'trip'])->name('trip')->middleware('role:Staff,Driver,Supervisor,Admin,Super');
Route::get('trip-report/{tripid}', [App\Http\Controllers\TripsController::class, 'newTripReport'])->name('trip-report')->middleware('role:Staff,Driver,Supervisor,Admin,Super');

Route::post('saveTripreport', [App\Http\Controllers\TripsController::class, 'saveTripreport'])->name('saveTripreport')->middleware('role:Staff,Driver,Supervisor,Admin,Super');

Route::post('assignDriver', [App\Http\Controllers\TripsController::class, 'store'])->name('assignDriver')->middleware('role:Admin,Super');
Route::get('driver-trips', [App\Http\Controllers\TripsController::class, 'driverTrips'])->name('driver-trips')->middleware('role:Driver,Admin,Super');
Route::post('drive', [App\Http\Controllers\TripsController::class, 'drive'])->name('drive')->middleware('role:Driver,Admin,Super');
Route::get('start-trip/{tripid}', [App\Http\Controllers\TripsController::class, 'startTrip'])->name('start-trip')->middleware('role:Driver,Admin,Super');

// Vehicles
Route::get('all-vehicles', [App\Http\Controllers\VehiclesController::class, 'index'])->name('all-vehicles')->middleware('role:Admin,Super');
Route::get('new-vehicle', [App\Http\Controllers\VehiclesController::class, 'create'])->name('new-vehicle')->middleware('role:Driver,Admin,Super');
Route::post('saveVehicle', [App\Http\Controllers\VehiclesController::class, 'store'])->name('saveVehicle')->middleware('role:Driver,Admin,Super');
Route::get('vehicle/{vid}', [App\Http\Controllers\VehiclesController::class, 'show'])->name('vehicle')->middleware('role:Admin,Super');
Route::post('updateVehicle', [App\Http\Controllers\VehiclesController::class, 'update'])->name('updateVehicle')->middleware('role:Driver,Admin,Super');


Route::get('/delete-vehicle/{vid}', [App\Http\Controllers\VehiclesController::class, 'destroy'])->name('delete-vehicle')->middleware('role:Admin,Super');


Route::post('updateRequest', [App\Http\Controllers\RequestsController::class, 'updateVehicle'])->name('updateVehicle')->middleware('role:Driver,Admin,Super');

Route::get('delete-request/{rid}', [App\Http\Controllers\RequestsController::class, 'destroy'])->name('delete-request')->middleware('role:Super');

//TASK
Route::get('tasks', [App\Http\Controllers\TasksController::class, 'index'])->name('tasks');
Route::get('project-task/{tid}', [App\Http\Controllers\TasksController::class, 'create'])->name('project-task');
Route::get('task/{tid}', [App\Http\Controllers\TasksController::class, 'viewTask'])->name('task');
Route::post('change_task_status', [App\Http\Controllers\TasksController::class, 'change_task_status'])->name('change_task_status');
Route::get('del-task/{tid}', [App\Http\Controllers\TasksController::class, 'destroy'])->name('del-task')->middleware('role:Admin,Super');
Route::get('new-task', [App\Http\Controllers\TasksController::class, 'newTask'])->name('new-task');
Route::post('saveTask', [App\Http\Controllers\TasksController::class, 'saveTask'])->name('saveTask');
Route::get('/completetask/{id}', [App\Http\Controllers\TasksController::class, 'completetask'])->name('completetask')->middleware('role:Client,Admin,Contributor,Pastor,Super');
Route::get('/inprogresstask/{id}', [App\Http\Controllers\TasksController::class, 'inprogresstask'])->name('inprogresstask')->middleware('role:Client,Admin,Contributor,Pastor,Super');


//REPORT
Route::get('new-task-report/{tid}', [App\Http\Controllers\MilestoneReportsController::class, 'newtaskReport'])->name('new-task-report')->middleware('role:Finance,Admin,Super');
Route::post('addtaskreport', [App\Http\Controllers\MilestoneReportsController::class, 'store'])->name('addtaskreport')->middleware('role:Finance,Admin,Super');
Route::get('task-report/{trid}', [App\Http\Controllers\MilestoneReportsController::class, 'milestonetaskReport'])->name('task-report')->middleware('role:Finance,Admin,Super');
Route::post('change_task_report_status', [App\Http\Controllers\MilestoneReportsController::class, 'change_task_report_status'])->name('change_task_report_status')->middleware('role:Finance,Admin,Super');


// ACCOUNT HEADS
Route::get('/account-heads', [App\Http\Controllers\AccountheadsController::class, 'index'])->name('account-heads')->middleware('role:Finance,Admin,Super');
Route::post('/addaccounthead', [App\Http\Controllers\AccountheadsController::class, 'store'])->name('addaccounthead')->middleware('role:Finance,Admin,Super');
Route::get('/delete-acch/{id}', [App\Http\Controllers\AccountheadsController::class, 'destroy'])->name('delete-acch')->middleware('role:Super');

// ACCOUNT HEADS
Route::get('/categories', [App\Http\Controllers\CategoriesController::class, 'index'])->name('categories')->middleware('role:Finance,Admin,Super');
Route::post('/addcategory', [App\Http\Controllers\CategoriesController::class, 'store'])->name('addcategory')->middleware('role:Finance,Admin,Super');
Route::get('/delete-cat/{id}', [App\Http\Controllers\CategoriesController::class, 'destroy'])->name('delete-cat')->middleware('role:Super');

// TRANSACTIONS
Route::get('/transactions', [App\Http\Controllers\TransactionsController::class, 'index'])->name('transactions')->middleware('role:Finance,Admin,Super');
Route::post('/addtransaction', [App\Http\Controllers\TransactionsController::class, 'store'])->name('addtransaction')->middleware('role:Finance,Admin,Super');
Route::get('/delete-trans/{id}', [App\Http\Controllers\TransactionsController::class, 'delTrans'])->name('delete-trans')->middleware('role:Finance,Super');

Route::post('/settings', [App\Http\Controllers\HomeController::class, 'settings'])->name('settings')->middleware('role:Super');

// Facilities
Route::resource('facilities', App\Http\Controllers\FacilitiesController::class)->middleware('role:Admin,Super');

// Route::get('facilities', [App\Http\Controllers\FacilitiesController::class,'index'])->middleware('role:Admin,Super');
Route::get('add_facility', [App\Http\Controllers\FacilitiesController::class,'create'])->name('add_facility')->middleware('role:Admin,Super');
Route::get('facility/{id}', [App\Http\Controllers\FacilitiesController::class,'edit'])->middleware('role:Admin,Super');
Route::get('delete-facility/{id}', [App\Http\Controllers\FacilitiesController::class,'destroy'])->middleware('role:Admin,Super');

// Audits
Route::get('audits', [App\Http\Controllers\AuditController::class,'index'])->middleware('role:Admin,Super');

// Departments
Route::resource('departments', App\Http\Controllers\DepartmentController::class)->middleware('auth');
Route::get('add_department', [App\Http\Controllers\DepartmentController::class,'create'])->name('add_department')->middleware('role:Admin,Super');
Route::get('delete-department/{id}', [App\Http\Controllers\DepartmentController::class,'destroy'])->middleware('role:Admin,Super');

// Units
Route::resource('units', App\Http\Controllers\UnitController::class)->middleware('auth');
Route::get('add_unit', [App\Http\Controllers\UnitController::class,'create'])->name('add_unit')->middleware('role:Admin,Super');
Route::get('delete-unit/{id}', [App\Http\Controllers\UnitController::class,'destroy'])->middleware('role:Admin,Super');

//LOGOUT
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class,'logout']);

// ARTISAN COMMANDS
Route::get('/artisan1/{command}', [App\Http\Controllers\HomeController::class, 'Artisan1'])->middleware('role:Super');
Route::get('/artisan2/{command}/{param}', [App\Http\Controllers\HomeController::class, 'Artisan2'])->middleware('role:Super');
