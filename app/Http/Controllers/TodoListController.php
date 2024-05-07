<?php

namespace App\Http\Controllers;

use App\Mail\UserVerificationMail;
use App\Models\TodoList;
use App\Models\TodoType;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;

class TodoListController extends Controller
{
    public function getTodoList()
    {

        try {

            $todoLists = TodoList::with("todoType")->get();

            return sendSuccessResponse("Todolist data get successfully", $todoLists);
        } catch (\Throwable $th) {

            return sendErrorResponse("Todo data get unsuccessful");
        }
    }
    public function deleteTodoList($id)
    {

        try {
            $todo = TodoList::findOrFail($id);
            $todo->delete();
            return sendSuccessResponse("Todo delete successfully");
        } catch (\Throwable $th) {

            return sendErrorResponse("Failed to delete todo");
        }
    }
    public function getTodoListById($id)
    {
        try {

            $todoList = TodoList::with("todoType")->findOrFail($id);
            return sendSuccessResponse("Todo details retrieved successfully", $todoList);
        } catch (\Throwable $th) {

            return sendErrorResponse("Todo not found");
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $todo = TodoList::findOrFail($id);

            $todo->update([
                "title" => $request->title,
                "deadline" => $request->deadline,
                "todo_type_id" => $request->type,
                "is_active" => $request->status
            ]);

            return sendSuccessResponse("Todo update successfully",  $todo);
        } catch (\Throwable $th) {

            return sendErrorResponse("Failed Todo update ");
        }
    }
    public function createTodo(Request $request)
    {
        try {

            $todo = TodoList::create([
                "title" => $request->title,
                "deadline" => $request->deadline,
                "todo_type_id" => $request->type,
                "is_active" => 0
            ]);


            return sendSuccessResponse("Todo added successfully", $todo);
        } catch (\Exception $ex) {

            return sendErrorResponse("Failed To add todo : " . $ex->getMessage());
        }
    }

    public function todoTypes()
    {
        try {
            $todoTypes = TodoType::all();
            return sendSuccessResponse("Todo types retrieved successfully", $todoTypes);
        } catch (\Exception $ex) {
            return sendErrorResponse("Failed to retrieve todo types :" . $ex);
        }
    }


    public function login(Request $request)
    {
        // dd($request);
        try {
            $userLogin = $request->only("email", "password");


            if (Auth::attempt($userLogin) && auth()->user()->is_verified) {

                return sendSuccessResponse("Login successfully", auth()->user());
            } else {
                return sendErrorResponse("Failed to Login :", "Wrong Credentials");
            }
        } catch (\Exception $ex) {
            return sendErrorResponse("Failed to Login :" . $ex);
        }
    }
    public function registration(Request $request)
    {
        try {
            $userRegistration = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => $request->password
            ]);
            $this->sendVerificationEmail($userRegistration);
            return sendSuccessResponse("Registration  successfully", $userRegistration);
        } catch (\Exception $ex) {

            return sendErrorResponse("Failed to Registration :" . $ex);
        }
    }
    public function me()
    {
        try {

            if (auth()->check()) {
                return sendSuccessResponse("User login", auth()->user());
            } else {
                return sendErrorResponse("User not login");
            }
        } catch (\Exception $ex) {

            return sendErrorResponse("Failed to Registration :" . $ex);
        }
    }

    private function sendVerificationEmail($user){
        Mail::to($user->email)->send(new UserVerificationMail($user->email));
    }
}
