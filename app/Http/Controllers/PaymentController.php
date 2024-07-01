<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Services\PaymentService;
use App\Jobs\ProcessPayment;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function store(CreatePaymentRequest $request): JsonResponse
    {
        $payment = $this->paymentService->createPayment($request->validated());
        ProcessPayment::dispatch($payment);
        return response()->json(['message' => 'Payment is being processed', 'payment_id' => $payment->id], 202);
    }

    
}