<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function handleRequest(Request $request)
    {
        return response()->json(['message' => 'Request handled successfully']);
    }
}
