<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Product;

class ApiController extends Controller
{
    public function users()
    {
        $users = User::orderBy('id', 'ASC')->paginate(10);
        return response()->json($users, 200);
    }

    public function products()
    {
        $products = Product::getAllProduct();
        return response()->json($products, 200); 
    }

    // thêm tiếp vào đây 
    
}
