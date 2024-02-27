<?php

namespace App\Services;

use App\Models\User;
use App\Repository\IUserRepository;
use Illuminate\Support\Facades\Hash;
use App\DTO\UserRegistrationDTO;

class UserService implements IUserService
{
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    
    public function registerUser(UserRegistrationDTO $userDTO)
    {
        return $this->userRepository->create([
            'name' => $userDTO->getName(),
            'email' => $userDTO->getEmail(),
            'password' => Hash::make($userDTO->getPassword()),
            'role_id' => 2,
        ]);
    }

    public function loginUser($email, $password)
    {
        $credentials = compact('email', 'password');

        if (auth()->attempt($credentials)) {
            return true;
        }

        return false;
    }

    public function logoutUser()
    {
        auth()->logout();
    }
}
