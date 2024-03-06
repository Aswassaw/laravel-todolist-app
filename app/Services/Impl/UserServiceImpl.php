<?php

namespace App\Services\Impl;

use App\Services\UserService;

class UserServiceImpl implements UserService
{
  private array $users = [
    "andry" => "aswassaw",
    "bagas" => "goodman",
    "adi" => "wibusejati"
  ];

  public function login(string $username, string $password): bool
  {
    if (!isset($this->users[$username])) return false;

    return $password === $this->users[$username];
  }
}
