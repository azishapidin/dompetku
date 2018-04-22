<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                  => 'required',
            'currency'              => 'required|in:'.implode(',', array_keys(config('currency'))),
            'image'                 => 'image|max:500',
            'balance'               => 'numeric',
            'currency_placement'    => 'required|in:before,after',
        ];
    }
}
