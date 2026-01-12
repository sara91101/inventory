<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


public function index()
{
    // Initialize array of 12 months with 0
    $totals = array_fill(1, 12, 0);

    // Get totals grouped by month
    $monthlyTotals = Purchase::whereYear('purchase_date', date('Y'))
        ->select(
            DB::raw('MONTH(purchase_date) as month'),
            DB::raw('SUM(full_amount) as total')
        )
        ->groupBy(DB::raw('MONTH(purchase_date)'))
        ->pluck('total', 'month'); // month => total

    // Fill the array with real values
    foreach ($monthlyTotals as $month => $total) {
        $totals[$month] = $total;
    }

    // Optional: reindex 0-based array (Jan = 0)
    $purchases = array_values($totals);


    

    // Get totals grouped by month
    $sales_totals = array_fill(1, 12, 0);
    $salesMonthlyTotals = Sale::whereYear('sale_date', date('Y'))
        ->select(
            DB::raw('MONTH(sale_date) as month'),
            DB::raw('SUM(full_amount) as total')
        )
        ->groupBy(DB::raw('MONTH(sale_date)'))
        ->pluck('total', 'month'); // month => total

    // Fill the array with real values
    foreach ($salesMonthlyTotals as $month => $total) {
        $sales_totals[$month] = $total;
    }

    // Optional: reindex 0-based array (Jan = 0)
    $sales = array_values($sales_totals);

    //return response()->json(['purchases' => $purchases , 'sales' => $sales]);

    return view('home', ['purchases' => $purchases , 'sales' => $sales]);
}

}
