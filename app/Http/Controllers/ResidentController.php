<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    function index()
    {
        return "<h1>Hello Resident</h1>";
    }
}
