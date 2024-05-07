<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoListController;
use App\Models\TodoType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/todo-list", [TodoListController::class, 'getTodoList']);
Route::delete("/todo-list/{id}", [TodoListController::class, 'deleteTodoList']);
Route::get("/todo-list/{id}", [TodoListController::class, 'getTodoListById']);
Route::put("/todo-list/{id}", [TodoListController::class, 'update']);
Route::post("/todo-list", [TodoListController::class, 'createTodo']);
Route::get("/todo-types", [TodoListController::class, 'todoTypes']);
Route::post("/login", [TodoListController::class, "login"]);
Route::post("/registration", [TodoListController::class, "registration"]);
Route::get("/me", [TodoListController::class, "me"]);
Route::get("/verify", [AuthController::class, "verify"]);
