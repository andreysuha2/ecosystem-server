<?php

namespace App\Http\Requests\Valet;

use Illuminate\Foundation\Http\FormRequest;

class ViewValetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $valet = $this->route('valet');
        return $valet && $this->user()->can('view', $valet);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
