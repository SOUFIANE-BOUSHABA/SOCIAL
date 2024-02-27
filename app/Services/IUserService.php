<?php

namespace App\Services;

use App\Models\User;
use App\DTO\UserRegistrationDTO;

interface IUserService 
{
    public function registerUser(UserRegistrationDTO $userDTO);
    public function loginUser($email, $password);
    public function logoutUser();
}
