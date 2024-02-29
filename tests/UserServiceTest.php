<?php

use App\DTO\UserRegistrationDTO;
use App\Models\User;
use App\Repository\IUserRepository;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    public function testRegisterUser()
    {
        // Mock IUserRepository
        $userRepository = $this->createMock(IUserRepository::class);

        $userService = new UserService($userRepository);

        // Set up test data
        $userData = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
        ];
        

        

        $userRegistrationDTO = new UserRegistrationDTO(   $userData['name'],  $userData['email'],  $userData['password']  );
        $userRepository->expects($this->once())
            ->method('create')
            ->with([
                'name' => $userRegistrationDTO->getName(),
                'email' => $userRegistrationDTO->getEmail(),
                'password' => Hash::make($userRegistrationDTO->getPassword()),
                'role_id' => 2,
            ]);
        $result = $userService->registerUser($userRegistrationDTO);
        

        $this->assertInstanceOf(User::class, $result , 'new user should be returned');
    }
}