<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $criticalProducts = Product::where('amount', '<=', 5)->get();
        $warningProducts = Product::whereBetween('amount', [6,30])->get();
        $normalProducts = Product::where('amount', '>',30)->get();
        return view('dashboard.dashboard', [
            'criticalProducts'=> $criticalProducts,
            'warningProducts' => $warningProducts,
            'normalProducts' => $normalProducts,
            
            'criticalCounts' => $criticalProducts->counts(),
            'warningProducts' => $warningProducts->counts(),
            'normalProducts' => $normalProducts->counts(),
            
            'totalProducts' => Product::count()
            ]);
    }
}
