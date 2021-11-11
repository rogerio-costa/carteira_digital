<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'account_id',
            'transaction_type_id' => 'required',
            'transaction_name',
            'type_of',
            'note' => 'max:255',
            'value' => 'required'
        ];
    }

    
    public function attributes()
    {
        return [
            'transaction_type_id' => 'Transação da Lista',
            'value' => 'Valor da Transação'
        ];
    }
}
