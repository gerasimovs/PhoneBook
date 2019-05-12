<?php

namespace App\Controllers;

use App\Views\ApplicationView;
use Symfony\Component\HttpFoundation\Response;

class ApplicationController
{
    public function index($request)
    {
        return new ApplicationView;
    }
}