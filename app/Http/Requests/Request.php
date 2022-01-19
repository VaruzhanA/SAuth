<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Request.
 */
abstract class Request extends FormRequest
{
    /**
     * @var string
     */
    protected $error = '';

    /**
     * @return $this
     */
    public function forbiddenResponse()
    {

        if (empty($error)) {
            $this->error = 'You do not have access to do that.';
        }

        return redirect()->back()->withErrors($this->error);
    }

    /**
     * @return array
     */
    public function onlyValidated()
    {
        return $this->only(array_keys($this->rules()));
    }

}
