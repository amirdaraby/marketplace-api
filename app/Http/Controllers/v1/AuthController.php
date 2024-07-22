<?php

namespace App\Http\Controllers\v1;

use App\Enums\RolesEnum;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseJson;
use App\Http\Requests\v1\Auth\LoginRequest;
use App\Http\Requests\v1\Auth\RegisterRequest;
use App\Http\Services\UserService;
use App\Repositories\UserAccessToken\UserAccessTokenRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(protected UserService $userService, protected UserAccessTokenRepositoryInterface $accessTokenRepository)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->except('role', 'location_x', 'location_y'), RolesEnum::CUSTOMER, $request->validated('location_x'), $request->validated('location_y'));

        $token = $this->accessTokenRepository->generate($user->id);

        return ResponseJson::success(['user' => $user, 'token' => $token->token], "User Created", Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->validated())) {
            $user = Auth::user();

            $token = $this->accessTokenRepository->generate($user->id);

            return ResponseJson::success(['user' => $user, 'token' => $token->token], "User Logged", Response::HTTP_OK);
        }

        return ResponseJson::error('Authentication Failed', Response::HTTP_UNAUTHORIZED);
    }
}
