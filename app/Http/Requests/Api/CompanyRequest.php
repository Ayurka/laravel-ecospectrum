<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

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
            'nameCompany' => 'required',
            'address' => 'required',
            'inn' => 'required',
            'kpp' => 'required'
        ];
    }

    /**
     * Получить сообщения об ошибках для определённых правил проверки.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nameCompany.required' => 'Необходимо указать компанию',
            'address.required' => 'Необходимо указать адрес',
            'inn.required' => 'Необходимо указать ИНН',
            'kpp.required' => 'Необходимо указать КПП'
        ];
    }
}
