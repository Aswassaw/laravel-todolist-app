<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get("/login")->assertSeeText("Login");
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            "username" => "andry"
        ])->get("/login")->assertRedirect("/");
    }

    public function testLoginSuccess()
    {
        $this->post("/login", [
            "username" => "andry",
            "password" => "aswassaw",
        ])->assertRedirect("/")->assertSessionHas("username", "andry");
    }

    public function testLoginForMember()
    {
        $this->withSession([
            "username" => "andry"
        ])->post("/login", [
            "username" => "andry",
            "password" => "aswassaw",
        ])->assertRedirect("/");
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

    public function testLogoutGuest()
    {
        $this->post("/logout")->assertRedirect("/login");
    }
}
