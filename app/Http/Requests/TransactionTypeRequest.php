<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionTypeRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'type_of' => ['required', 'boolean']
        ];
    }


    /*
    public function attributes()
    {
        return [
            'name' => 'nome',
            'type_of' => 'tipo da transação'
        ];
    }*/
    

    /*
    public function messages()
    {
        return [
            'required' => 'Testando menssagem manual de erro'
        ];
    }
    */

}
