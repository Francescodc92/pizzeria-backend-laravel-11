<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PizzaTrait;

class EmployeePizzaController extends Controller
{
    use PizzaTrait;

    protected function getViewPrefix()
    {
        return 'employee';
    }
}
