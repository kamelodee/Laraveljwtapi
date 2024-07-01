<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    public function create(array $data): Product
    {
       
        return Product::create($data);
    }

    public function findById(int $id): ?Product
    {
        return Product::find($id);
    }

    public function update(Product $product, array $data): bool
    {
        return $product->update($data);
    }

    public function delete(Product $product): bool
    {
        return $product->delete();
    }

    public function all(): Collection
    {
        // dd(Product::with('user')->get());
        return Product::with('user')->get();
    }
}