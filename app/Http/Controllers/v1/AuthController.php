<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseJson;
use App\Http\Requests\v1\Auth\LoginRequest;
use App\Http\Requests\v1\Auth\RegisterRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserAccessToken\UserAccessTokenRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(protected UserRepositoryInterface $userRepository, protected UserAccessTokenRepositoryInterface $accessTokenRepository)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->userRepository->create($request->validated());

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
