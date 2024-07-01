<?php
namespace App\Repositories;

use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
class PaymentRepository
{
    public function create(array $data): Payment
    {
       
        $data['payment_gateway']="Stripe";
        return Payment::create($data);
    }

    public function findById(int $id): ?Payment
    {
        return Payment::find($id);
    }

    public function update(Payment $payment, array $data): bool
    {
        return $payment->update($data);
    }

    public function all(): Collection
    {
        // dd(Product::with('user')->get());
        return Payment::with('user')->get();
    }
}