<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmPaymentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'amount' => 'required|numeric|min:0',
            'product_id' => 'required|exists:products,id',
        ];
    }
}