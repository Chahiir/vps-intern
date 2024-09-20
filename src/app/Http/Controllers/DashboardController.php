<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Remarques;
use App\Models\Salarier;
use App\Models\Visiteur;

class DashboardController extends Controller
{
    public function index()
    {
        $badgeDispo = Badge::whereIn('type_id', [3, 7])->where('taken', 0)->count();
        $badgeIndispo = Badge::whereIn('type_id', [3, 7])->where('taken', 1)->count();

        $salaries = Salarier::Where('active', 1)->count();

        $salarieServiceCount = Salarier::where('active', 1)
            ->selectRaw('service_id, COUNT(*) as count')
            ->groupBy('service_id')
            ->with('service')
            ->get();

            // Format the data for Chart.js
$labelsSalarie = [];
$dataSalarie = [];

foreach ($salarieServiceCount as $item) {
    $labelsSalarie[] = $item->service->name ?? 'Unknown Service';
    $dataSalarie[] = $item->count;
}
//dd($labelsSalarie,$dataSalarie,$salarieServiceCount);
        $visitStatistics = Visiteur::selectRaw('DATE_FORMAT(entrer, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
            $dates = $visitStatistics->pluck('month');
            $counts = $visitStatistics->pluck('count');

        $evaluationScores = Remarques::select('salarie_id')
            ->selectRaw('AVG(note_final) as average_score')
            ->groupBy('salarie_id')
            ->with('salarie.service')
            ->get();

        // Format the data for Chart.js
        $labels = [];
        $data = [];

        foreach ($evaluationScores as $evaluation) {
            $labels[] = $evaluation->salarie->service->name ?? 'Service inconnue'; // Adjust based on your column names
            $data[] = $evaluation->average_score;
        }


        return view('content.dashboard.dashboard', compact('badgeDispo', 'badgeIndispo', 'salaries','dataSalarie','labelsSalarie','dates','counts' ,'data' , 'labels'));
    }
}
