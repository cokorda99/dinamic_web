<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\User;
use App\Models\Product;
use App\Models\Brand;
use App\Models\GeneralSetting;


class AdminDashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->isMethod('get')) {
            # code...
            //READ
            $title = 'Dashboard';
            $setting = GeneralSetting::first();
            return view('admin.dashboard', compact('title','setting'));
        }else{
            // Handle other methods
            return response()->json(['message' => 'Method not allowed'], 405);
        }
    }

}
