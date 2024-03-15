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

    public function todoList(Request $request)
    {
        return response()->view("todolist.todolist", [
            "title" => "Todo List",
            "todolist" => $this->todolistService->getTodoList(),
        ]);
    }

    public function addTodo(Request $request)
    {
    }

    public function removeTodo(Request $request, string $todoId)
    {
    }
}
