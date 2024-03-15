<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
}
