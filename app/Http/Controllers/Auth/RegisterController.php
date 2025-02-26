<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Http;
use Exception;

class RegisterController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('guest');
        $this->userService = $userService;
    }

    /**
     * User registration logic
     */
    public function register(RegisterRequest $request)
    {
        try {
            $loginData = $this->userService->register($request->validated());
            Http::withHeaders([
                'Authorization' => "Bearer {$loginData['jwe_token']}",
                'Auth-Token' => $loginData['auth_token'],
            ])->post(config('app.main_site_url'));
            return redirect(config('app.main_site_url'));
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
