<?php

namespace App\Http\Controllers\v1;

use App\Enums\PermissionsEnum;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseJson;
use App\Http\Requests\v1\Market\StoreRequest;
use App\Http\Requests\v1\Market\UpdateRequest;
use App\Http\Services\MarketService;
use App\Repositories\Market\MarketRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class MarketController extends Controller
{
    public function __construct(protected MarketRepositoryInterface $marketRepository, protected MarketService $marketService)
    {
    }

    public function index(): JsonResponse
    {
        $markets = $this->marketRepository->listPaginated();

        return ResponseJson::success($markets, "Markets list", Response::HTTP_OK);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $market = $this->marketService->createMarket($request);

        return ResponseJson::success(null, "Market created", Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $market = $this->marketRepository->findOrFailById($id);

        return ResponseJson::success($market, "Market show", Response::HTTP_OK);
    }

    public function update($id, UpdateRequest $request): JsonResponse
    {
        $market = $this->marketRepository->findOrFailById($id);

        Gate::authorize(PermissionsEnum::SELLER_UPDATE->value, $market);

        $updated = $this->marketRepository->updateById($market->id, $request->validated());

        return ResponseJson::success($updated, "Market updated", Response::HTTP_ACCEPTED);
    }

    public function delete($id): JsonResponse
    {
        $market = $this->marketRepository->findOrFailById($id);

        Gate::authorize(PermissionsEnum::SELLER_DELETE->value, $market);

        $deleted = $this->marketRepository->deleteById($id);

        return ResponseJson::success($deleted, "Market deleted", Response::HTTP_ACCEPTED);
    }
}
