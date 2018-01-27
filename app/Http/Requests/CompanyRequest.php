<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CompanyCnpj;

class CompanyRequest extends FormRequest
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
            'name' => 'required|string|min:4|max:100',
            // 'cnpj' => 'required|numeric|unique:companies|digits:14',
            'cnpj' => ['required', 'numeric', 'unique:companies', 'digits:14', new CompanyCnpj]
        ];
    }

    public function attributes()
    {
        return[
            'name' => 'NOME FANTASIA',
            'cnpj' => 'CNPJ'
        ];
    }
}
