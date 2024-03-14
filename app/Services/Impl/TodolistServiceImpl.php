<?php

namespace App\Services\Impl;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService
{
  public function saveTodo(string $id, string $todo): void
  {
    if (!Session::exists("todolist")) {
      Session::put("todolist", []);
    }

    Session::push("todolist", [
      "id" => $id,
      "todo" => $todo,
    ]);
  }

  public function getTodoList(): array
  {
    if (!Session::exists("todolist")) {
      Session::put("todolist", []);
    }

    return Session::get("todolist");
  }

  public function removeTodo($todoId): void
  {
    $todoList = Session::get("todolist");

    foreach ($todoList as $index => $value) {
      if ($value["id"] === $todoId) {
        unset($todoList[$index]);
        break;
      }
    }

    Session::put("todolist", $todoList);
  }
}
