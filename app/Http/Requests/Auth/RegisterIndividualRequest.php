<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegisterIndividualRequest extends Request
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
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|string|email|max:255',
            'password' => 'required|max:15',
            'contact-type' => 'required'
        ];
    }


}
