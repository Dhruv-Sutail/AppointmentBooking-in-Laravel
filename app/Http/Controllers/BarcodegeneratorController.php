<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarcodegeneratorController extends Controller
{
    public function barcode()
    {
        return view('barcodegenerator');

    }
}
