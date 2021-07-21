<?php

namespace App\Http\Requests\Valet;

use App\Models\Valet\Valet;
use Illuminate\Foundation\Http\FormRequest;

class CreateValetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Valet::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'default_currency' => 'required|exists:currencies,id',
            'balances' => 'required|array|present',
            'balances.*.value' => 'required|numeric',
            'balances.*.currency' => 'required|exists:currencies,id',
            'balance.*.date' => 'required|date|date_format:Y-m-d H:i:s'
        ];
    }
}
