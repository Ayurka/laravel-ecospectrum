<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'name' => 'required|min:3',
            'lastName' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required'
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
            'name.required' => 'Необходимо указать имя',
            'name.min' => 'Длина имени должна быть не менее 3 символов',
            'lastName.required' => 'Необходимо указать фамилию',
            'lastName.min' => 'Длина фамилии должна быть не менее 3 символов',
            'email.required' => 'Необходимо указать email',
            'email.email' => 'Укажите корректную почту',
            'phone.required' => 'Необходимо указать телефон'
        ];
    }
}
