<?php

namespace App\Http\Controllers\v1;

use App\Enums\PermissionsEnum;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseJson;
use App\Http\Requests\v1\Product\StoreRequest;
use App\Http\Requests\v1\Product\UpdateRequest;
use App\Http\Services\ProductService;
use App\Repositories\Market\MarketRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function __construct(protected ProductRepository $productRepository, protected ProductService $productService, protected MarketRepositoryInterface $marketRepository)
    {
    }

    public function index()
    {
        $products = $this->productService->productFromNearlyMarkets(Auth::id());

        return ResponseJson::success($products, 'products list', Response::HTTP_OK);
    }

    public function store(StoreRequest $request)
    {
        $market = $this->marketRepository->findOrFailById($request->validated('market_id'));

        Gate::authorize(PermissionsEnum::SELLER_UPDATE->value, $market);

        $product = $this->productRepository->create($request->validated());

        return ResponseJson::success($product, 'product created', Response::HTTP_CREATED);
    }

    public function update(UpdateRequest $request, int $id)
    {
        $product = $this->productRepository->findOrFailById($id);

        $market = $product->market;

        Gate::authorize(PermissionsEnum::SELLER_UPDATE->value, $market);

        $updated = $this->productRepository->updateById($product->id, $request->validated());

        return ResponseJson::success($updated, 'product updated', Response::HTTP_ACCEPTED);
    }

    public function delete(int $id)
    {
        $product = $this->productRepository->findOrFailById($id);

        $market = $product->market;

        Gate::authorize(PermissionsEnum::SELLER_UPDATE->value, $market);

        $deleted = $this->productRepository->deleteById($id);

        return ResponseJson::success($deleted, 'product deleted', Response::HTTP_ACCEPTED);
    }
}
