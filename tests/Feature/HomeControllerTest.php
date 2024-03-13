<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testGuest(): void
    {
        $this->get("/")->assertRedirect("/login");
    }

    public function testMember()
    {
        $this->withSession(["username" => "andry"])->get("/")->assertRedirect("/todolist");
    }
}
