<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketManagerController;
use App\Http\Controllers\RecallController;
use App\Http\Controllers\TicketTransfertController;
use App\Http\Controllers\SchedulingController;
use App\Http\Controllers\FeedbackController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'verified']);
Route::resource('users', UserController::class)->middleware(['auth', 'verified']);
Route::resource('service', ServiceController::class)->middleware(['auth', 'verified']);
Route::resource('department', DepartmentController::class)->middleware(['auth', 'verified']);
Route::resource('ticket', TicketController::class)->middleware(['auth', 'verified']);
Route::get('/intreatment', [TicketController::class, 'inTreatment'])->middleware('auth');
Route::get('/ticketService', [TicketManagerController::class, 'getServiceTicket'])->middleware('auth');
Route::get('/asign-to-me', [TicketManagerController::class, 'ticketAssignToUser'])->middleware('auth');
Route::post('/asign-to-me', [TicketManagerController::class, 'asignToMe'])->middleware('auth');
Route::get('/notresolved', [TicketController::class, 'ticketNotResolved'])->middleware('auth');
Route::get('/resolved', [TicketController::class, 'ticketResolved'])->middleware('auth');
Route::get('/inappointment', [TicketController::class, 'ticketInAppointment'])->middleware('auth');
Route::POST('/ticket_opened', [TicketController::class, 'openTicket'])->middleware('auth');
Route::POST('/validating_result', [TicketController::class, 'validateResult'])->middleware('auth');
Route::POST('/recall', [RecallController::class, 'store'])->middleware('auth');
Route::POST('/transfert_ticket', [TicketTransfertController::class, 'store'])->middleware('auth');
Route::Post('/scheduled', [SchedulingController::class, 'store'])->middleware('auth');
Route::resource('feedback', FeedbackController::class)->middleware('auth');