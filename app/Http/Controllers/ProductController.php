<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function store(CreateProductRequest $request): JsonResponse
    {
        $product = $this->productService->createProduct($request->validated());
        return (new ProductResource($product))->response()->setStatusCode(201);
    }

    public function update(UpdateProductRequest $request, $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $updatedProduct = $this->productService->updateProduct($product, $request->validated());
        return (new ProductResource($updatedProduct))->response()->setStatusCode(200);
    }

    public function destroy($id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $this->productService->deleteProduct($product);
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    public function index(): JsonResponse
    {
        $products = $this->productService->getAllProducts();
        return ProductResource::collection($products)->response();
    }

    public function show($id): JsonResponse
    {
        $product = Product::findOrFail($id);
        return (new ProductResource($product))->response();
    }
}