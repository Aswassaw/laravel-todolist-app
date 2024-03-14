<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodoListNotNull()
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo("1", "Test Todo 1");

        $todolist = Session::get("todolist");
        foreach ($todolist as $value) {
            self::assertEquals("1", $value["id"]);
            self::assertEquals("Test Todo 1", $value["todo"]);
        }
    }

    public function testTodolistEmpty()
    {
        self::assertEquals([], $this->todolistService->getTodoList());
    }

    public function testGetTodolistNotEmpty()
    {
        $expected = [
            [
                "id" => "1",
                "todo" => "Test Todo 1",
            ]
        ];

        $this->todolistService->saveTodo("1", "Test Todo 1");

        self::assertEquals($expected, $this->todolistService->getTodoList());
    }

    public function testRemoveTodo()
    {
        $this->todolistService->saveTodo("1", "Test Todo 1");
        self::assertEquals(1, sizeof($this->todolistService->getTodoList()));

        $this->todolistService->removeTodo("1");
        self::assertEquals([], $this->todolistService->getTodoList());
    }
}
