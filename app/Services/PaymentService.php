<?php
namespace App\Services;

use App\Repositories\PaymentRepository;
use App\Models\Payment;
use App\Enums\PaymentStatus;
use App\Events\PaymentProcessed;
use App\Models\Product;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use Stripe\Customer;
use Stripe\Sess;
use Stripe\Charge;
use Illuminate\Database\Eloquent\Collection;

class PaymentService
{
    private $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
        Stripe::setApiKey(config('stripe.secret'));
    }

    public function createPayment(array $data): Payment
    {
        $data['status'] = PaymentStatus::PENDING;
        return $this->paymentRepository->create($data);
    }

    public function processPayment(Payment $payment)

    {
        info( $payment);
        try {
   
       
        $data= PaymentIntent::create([
            'amount' =>  round($payment->amount),
            'currency' => 'usd',
            'automatic_payment_methods' => ['enabled' => true],
          ]);
          info($data);
        
          $payment->update(['payment_intend_id'=>$data->id]);
         

                    } catch (\Exception $e) {
            $this->paymentRepository->update($payment, ['status' => PaymentStatus::FAILED]);
            throw $e;
        }
    }

    public function getAllProducts(): Collection
    {
        return $this->paymentRepository->all();
    }
}