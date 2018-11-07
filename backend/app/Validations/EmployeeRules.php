<?php
/**
 * Criado através de FileTemplate por Kevin.
 */

/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 15/10/18
 * Time: 12:48
 */

namespace App\Validators;

use App\Models\Employee;
use Illuminate\Validation\Rule;


/**
 * Class EmployeeRules
 * @package App\Validators
 */
class EmployeeRules
{

    /**
     * Regras para criação de Employee
     * @return array
     * @throws \ReflectionException
     */
    static public function store(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3'
            ],
            'status' => [
                Rule::in(array_keys(Employee::getStatus()))
            ],
            'user_id' => [
                'required',
                'exists:users,id'
            ],
        ];
    }

    /**
     * Regras para alteração de Employee
     * @return array
     * @throws \ReflectionException
     */
    static public function update(): array
    {
        return [
            'name' => [
                'string',
                'min:3'
            ],
            'status' => [
                Rule::in(array_keys(Employee::getStatus()))
            ],
        ];
    }
}
