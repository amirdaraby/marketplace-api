<?php

namespace App\Http\Controllers\v1;

use App\Enums\PermissionsEnum;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseJson;
use App\Http\Requests\v1\User\StoreRequest;
use App\Http\Requests\v1\User\UpdateRequest;
use App\Http\Services\UserService;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(protected UserRepositoryInterface $userRepository, protected UserService $userService)
    {
    }

    public function index(): JsonResponse
    {
        $users = $this->userRepository->listPaginated();

        return ResponseJson::success($users->toArray(), "List of all users", Response::HTTP_OK);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->except('role'), $request->get('role'), $request->validated('location_x'), $request->validated('location_y'));

        return ResponseJson::success($user, "User created", Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->userRepository->findOrFailById($id);

        Gate::authorize(PermissionsEnum::USER_SHOW->value, $user);

        return ResponseJson::success($user, "User retrieved", Response::HTTP_OK);
    }

    public function update(int $id, UpdateRequest $request): JsonResponse
    {
        $user = $this->userRepository->findOrFailById($id);

        Gate::authorize(PermissionsEnum::USER_UPDATE->value, $user);

        $updated = $this->userRepository->updateById($user->id, $request->validated());

        return ResponseJson::success($updated, "User updated", Response::HTTP_ACCEPTED);
    }

    public function delete(int $id): JsonResponse
    {
        $user = $this->userRepository->findOrFailById($id);

        Gate::authorize(PermissionsEnum::USER_DELETE->value, $user);

        $deleted = $this->userRepository->deleteById($user->id);

        return ResponseJson::success($deleted, "User deleted", Response::HTTP_ACCEPTED);
    }
}
