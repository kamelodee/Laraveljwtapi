<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'items' => 'required',
            'user_id' => 'required',
            
        ];
    }
}