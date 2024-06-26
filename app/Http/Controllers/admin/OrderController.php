<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\OrderTrait;

class OrderController extends Controller
{
    use OrderTrait;
    
    protected function getViewPrefix()
    {
        return 'admin';
    }
}
