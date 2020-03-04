<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user('admin');
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
            'email' => 'required|email|max:255|unique:users,email,' . $this->user,
            'phone' => 'required',
            'password'  => 'required|min:4|confirmed',
            'company.nameCompany' => 'required',
            'company.address' => 'required',
            'company.inn' => 'required',
            'company.kpp' => 'required',
            'company.nameBank' => 'required',
            'company.bik' => 'required',
            'company.paymentAccount' => 'required',
            'company.correlationAccount' => 'required',
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
            'email.unique' => 'Такой email уже существует',
            'phone.required' => 'Необходимо указать телефон',
            'password.required' => 'Необходимо указать пароль',
            'password.min' => 'Длина пароля должна быть не менее 4 символов',
            'password.confirmed' => 'Пароли не совпадают',
            'company.nameCompany.required' => 'Необходимо указать наименование организации',
            'company.address.required' => 'Необходимо указать юридический адрес',
            'company.inn.required' => 'Необходимо указать ИНН',
            'company.kpp.required' => 'Необходимо указать КПП',
            'company.nameBank.required' => 'Необходимо указать наименование банка',
            'company.bik.required' => 'Необходимо указать БИК',
            'company.paymentAccount.required' => 'Необходимо указать расчетный счет',
            'company.correlationAccount.required' => 'Необходимо указать кор. счет',
        ];
    }
}
