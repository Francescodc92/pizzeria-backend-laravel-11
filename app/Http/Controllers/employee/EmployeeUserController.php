<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\UserTrait;
use Illuminate\Http\Request;

class EmployeeUserController extends Controller
{
    use UserTrait;

    protected function getViewPrefix()
    {
        return 'employee';
    }
}
