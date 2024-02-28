<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\IUserService;
use App\DTO\UserRegistrationDTO;
class AuthController extends Controller
{
    protected $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view("auth.login");
    }

    public function showForm()
    {
        return view("auth.register");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $userRegistrationDTO = new UserRegistrationDTO(
            $request->input('name'),
            $request->input('email'),
            $request->input('password')
        );
    
        $this->userService->registerUser($userRegistrationDTO);

        Session::flash('success', 'Registration successful. Please login.');

        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($this->userService->loginUser($credentials['email'], $credentials['password'])) {
            return redirect()->route('frontOffice.home');
        }

        return redirect()->route('login')->with('error', 'Invalid login credentials. Please try again.');
    }

    public function logout(Request $request)
    {
        $this->userService->logoutUser();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('frontOffice.home');
    }
}