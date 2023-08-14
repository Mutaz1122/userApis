<?php
namespace App\Helpers;

class UserValidationRules
{
    public static function userCreateRules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8',
        ];
    }

}