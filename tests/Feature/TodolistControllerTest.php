<?php

namespace Tests\Feature;

use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testTodolist(): void
    {
        $this->withSession([
            "username" => "andry",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Andry",
                ]
            ]
        ])->get("/todolist")
            ->assertSeeText("1")
            ->assertSeeText("Andry");
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            "username" => "andry",
        ])->post("/todolist", [])->assertSeeText("Todo is required");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "username" => "andry"
        ])->post("/todolist", [
            "todo" => "Bambang Note"
        ])->assertRedirect("/todolist");
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            "username" => "andry",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Andry",
                ],
                [
                    "id" => "2",
                    "todo" => "Budi",
                ],
            ]
        ])->post("/todolist/1/delete")->assertRedirect("/todolist");
    }
}
