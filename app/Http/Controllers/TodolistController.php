<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function todoList()
    {
        return response()->view("todolist.todolist", [
            "title" => "Todo List",
            "todolist" => $this->todolistService->getTodoList(),
        ]);
    }

    public function addTodo(Request $request)
    {
        $todo = $request->input("todo");

        if (empty($todo)) {
            $todoList = $this->todolistService->getTodoList();
            return response()->view("todolist.todolist", [
                "title" => "Todo List",
                "todolist" => $todoList,
                "error" => "Todo is required",
            ]);
        }

        $this->todolistService->saveTodo(uniqid(), $todo);
        return redirect()->action([TodolistController::class, "todoList"]);
    }

    public function removeTodo(Request $request, string $todoId)
    {
    }
}
