<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class EmployeeForbiddenException extends Exception
{
    public function __construct()
    {
        parent::__construct(__('exceptions.employee.forbidden'), Response::HTTP_FORBIDDEN);
    }
}
