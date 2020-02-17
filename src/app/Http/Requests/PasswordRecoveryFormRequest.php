<?php

namespace Globaldevteam\LaravelApiPasswordReset\app\Http\Requests;

use Globaldevteam\LaravelApiPasswordReset\app\Models\PasswordReset;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRecoveryFormRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return PasswordReset::baseRules();

            case 'DELETE':
                return PasswordReset::deleteRules();

            default:
                return [];
        }
    }
}
