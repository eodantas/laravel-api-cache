<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateLessonRequest extends FormRequest
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
        $uuid = $this->lesson ?? '';

        return [
            'name' => ['required', 'min:3', 'max:255', Rule::unique('lessons')->ignore($uuid, 'uuid')],
            'video' => ['required', 'min:3', 'max:255', Rule::unique('lessons')->ignore($uuid, 'uuid')],
            'description' => ['required', 'min:3', 'max:255']
        ];
    }
}
