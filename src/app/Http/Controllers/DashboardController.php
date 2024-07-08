<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\BadgeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){

     /* $badges = Badge::select('type_id',
        DB::raw('SUM(CASE WHEN taken = 1 THEN 1 ELSE 0 END) as taken_count'),
        DB::raw('SUM(CASE WHEN taken = 0 THEN 1 ELSE 0 END) as not_taken_count'))
          ->groupBy('type_id')
          ->get();
      return view('content.dashboard.dashboard')->with('badges',$badges);*/
      return view('content.dashboard.dashboard');
    }
}
