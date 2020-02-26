<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'title_group' => ['required', 'max:255'],
            'attr_old.*.value' => ['required', 'max:255'],
            'attr_new.*.value' => ['required', 'max:255'],
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
            'title_group.required' => 'Необходимо указать группу фильтров',
            'attr_old.*.value.required' => 'Необходимо указать название фильтра',
            'attr_new.*.value.required' => 'Необходимо указать название фильтра',
        ];
    }
}
