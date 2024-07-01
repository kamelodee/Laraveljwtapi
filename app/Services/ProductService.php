<?php
namespace App\Services;

use App\Repositories\ProductRepository;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function createProduct(array $data): Product
    {
        return $this->productRepository->create($data);
    }

    public function updateProduct(Product $product, array $data): Product
    {
        $this->productRepository->update($product, $data);
        return $product->fresh();
    }

    public function deleteProduct(Product $product): bool
    {
        return $this->productRepository->delete($product);
    }

    public function getAllProducts(): Collection
    {
        return $this->productRepository->all();
    }

    public function getProductById(int $id): ?Product
    {
        return $this->productRepository->findById($id);    }
}