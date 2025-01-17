<?php

namespace App\Jobs;

use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payment;

   
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

   
    public function handle(PaymentService $paymentService)
    {
        $paymentService->processPayment($this->payment);
    }

    public function failed()
{
    $this->release() ;
}
}