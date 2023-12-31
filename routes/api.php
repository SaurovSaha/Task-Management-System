<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

use App\Http\Middleware\TokenVerificationMiddleware;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



//page routes
Route::view('/Registation', 'pages.auth.registration-page');
Route::view('/Login', 'pages.auth.login-page');
Route::view('/Profile', 'pages.dashboard.profile-page')->middleware([TokenVerificationMiddleware::class]);



//backend routes
Route::post("/userLogin", [UserController::class, 'userLogin']);
Route::get("/userProfile", [UserController::class, 'userProfile'])->middleware([TokenVerificationMiddleware::class]);
Route::put("/userProfile", [UserController::class, 'update'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/userLogout", [UserController::class, 'userLogout'])->middleware([TokenVerificationMiddleware::class]);

Route::view('/projects', 'pages.dashboard.projects-page')->middleware([TokenVerificationMiddleware::class]);
Route::post("/projects", [ProjectController::class, 'store'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/projects/list', [ProjectController::class, 'index'])->name('projects.index')->middleware([TokenVerificationMiddleware::class]);
Route::get("/projects/{project}", [ProjectController::class, 'show'])->name('projects.show')->middleware([TokenVerificationMiddleware::class]);
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update')->middleware([TokenVerificationMiddleware::class]);
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy')->middleware([TokenVerificationMiddleware::class]);


Route::view('/tasks', 'pages.dashboard.tasks-page')->middleware([TokenVerificationMiddleware::class]);
Route::post("/tasks", [TaskController::class, 'store'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/tasks/list", [TaskController::class, 'index'])->name('tasks.index')->middleware([TokenVerificationMiddleware::class]);
Route::put("/tasks/{task}", [TaskController::class, 'update'])->name('tasks.update')->middleware([TokenVerificationMiddleware::class]);
Route::get("/tasks/{task}", [TaskController::class, 'show'])->name('tasks.show')->middleware([TokenVerificationMiddleware::class]);
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy')->middleware([TokenVerificationMiddleware::class]);