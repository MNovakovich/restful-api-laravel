<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UsersUpdateRequest extends FormRequest
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
        
           'email'=>'email|unique:users',
           'password'=>'min:5|confirmed',
           'admin'=>'in:'.User::ADMIN_USER. ', '.User::REGULAR_USER
        ];
    }
}
