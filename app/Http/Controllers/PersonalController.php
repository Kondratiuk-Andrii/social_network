<?php

namespace App\Http\Controllers;

class PersonalController extends Controller
{
    public function index()
    {
        return inertia('Personal/Index');
    }
}
