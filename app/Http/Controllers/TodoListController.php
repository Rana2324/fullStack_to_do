<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\TodoType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
}
