<?php

namespace App\Http\Requests\Frontend\User\Registration;

use App\Http\Requests\Request;

class StepRequest extends Request
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
        return [];
    }

    /**
     * @return array
     */
    public function onlyValidated()
    {
        return $this->only(array_keys($this->rules()));
    }
}
