<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository
{
    public function create(array $data): Order
    {
       
        return Order::create($data);
    }

    public function findById(int $id): ?Order
    {
        return Order::find($id);
    }

    public function update(Order $product, array $data): bool
    {
        return $product->update($data);
    }

    public function delete(Order $product): bool
    {
        return $product->delete();
    }

    public function all(): Collection
    {
        // dd(Product::with('user')->get());
        return Order::with('user')->get();
    }
}