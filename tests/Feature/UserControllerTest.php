<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLogin()
    {
        $this->get("/login")->assertSeeText("Login");
    }

    public function testLoginSuccess()
    {
        $this->post("/login", [
            "username" => "andry",
            "password" => "aswassaw",
        ])->assertRedirect("/")->assertSessionHas("username", "andry");
    }

    public function testLoginValidationError()
    {
        $this->post("/login", [])->assertSeeText("User or Password is required!");
    }

    public function testLoginFailed()
    {
        $this->post("/login", [
            "username" => "adi",
            "password" => "sejatiwibu",
        ])->assertSeeText("User or Password not correct!");
    }

    public function testLogout()
    {
        $this->withSession([
            "username" => "andry",
        ])->post("/logout")->assertRedirect("/")->assertSessionMissing("username");
    }
}
