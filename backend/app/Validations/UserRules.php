<?php
/**
 * Criado através de FileTemplate por Kevin.
 */

/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 15/10/18
 * Time: 12:49
 */

namespace App\Validators;

use App\Models\User;
use Illuminate\Validation\Rule;


/**
 * Class UserRules
 * @package App\Validators
 */
class UserRules
{
    /**
     * @return array
     */
    static public function login(): array
    {
        return [

            'email' => 'required|string|exists:' . (new User)->getTable(),
            'password' => 'required|string',
        ];
    }

    /**
     * Regras para criação de User
     * @return array
     */
    static public function store(): array
    {
        return [
            'name' => [
                'required',
                'min:3'
            ],
            'email' => [
                'required',
                'unique:users'
            ],
            'password' => [
                'required',
                'min:6',
                'confirmed'
            ],
        ];
    }

    /**
     * Regras para alteração de User
     * @return array
     */
    static public function update(): array
    {
        return [
            'name' => [
                'min:3'
            ],
            'email' => [
                'unique:users'
            ],
            'old_password' => [
              'required_with:new_password'
            ],
            'new_password' => [
                'required_with:old_password',
                'min:6',
                'confirmed'
            ],
        ];
    }
}
