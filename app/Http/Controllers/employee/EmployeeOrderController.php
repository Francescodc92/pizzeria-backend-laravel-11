<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\OrderTrait;

class EmployeeOrderController extends Controller
{
    use OrderTrait;
    
    protected function getViewPrefix()
    {
        return 'employee';
    }
}
