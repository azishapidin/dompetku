<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
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
            'from'          => 'required|exists:accounts,id|different:to',
            'to'            => 'required|exists:accounts,id|different:from',
            'amount'        => 'required',
            'category_id'   => 'required|exists:transaction_category,id',
            'date'          => 'required|date_format:"Y-m-d"',
            'description'   => 'required|max:255',
        ];
    }
}
