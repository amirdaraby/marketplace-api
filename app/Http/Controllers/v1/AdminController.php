<?php

namespace App\Http\Controllers\v1;

use App\Enums\RolesEnum;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseJson;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {
    }

    public function index(): JsonResponse
    {
        $admins = $this->userRepository->listByRole(RolesEnum::ADMIN);

        return ResponseJson::success($admins->toArray(), "List of admins",Response::HTTP_OK);
    }
}
