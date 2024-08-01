<?php

namespace App\Http\Controllers;

use App\Exports\BadgesExport;
use App\Exports\PartenairesExport;
use App\Exports\PartenaireVisitesExport;
use App\Exports\SalariersExport;
use App\Exports\UserExport;
use App\Exports\VisiteursExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
      $this->authorize('rapports');
        return view('content.export');
    }

    public function exportExcel(Request $request)
    {
      $this->authorize('rapports');
        switch ($request->data) {
            case 1:
                return Excel::download(new SalariersExport, 'Salariers.xlsx');
            case 2:
                return Excel::download(new PartenairesExport, 'Partenaire.xlsx');
            case 3:
                return Excel::download(new VisiteursExport, 'Visiteurs.xlsx');
            case 4:
                return Excel::download(new PartenaireVisitesExport, 'PartenaireVisit.xlsx');
            case 5:
                return Excel::download(new BadgesExport, 'Badges.xlsx');
            case 6:
                return Excel::download(new UserExport, 'Users.xlsx');
        }
    }

    public function exportCSV(Request $request)
    {
      $this->authorize('rapports');
        switch ($request->data) {
            case 1:
                return Excel::download(new SalariersExport, 'Salariers.csv', \Maatwebsite\Excel\Excel::CSV);
            case 2:
                return Excel::download(new PartenairesExport, 'Partenaire.csv', \Maatwebsite\Excel\Excel::CSV);
            case 3:
                return Excel::download(new VisiteursExport, 'Visiteurs.csv', \Maatwebsite\Excel\Excel::CSV);
            case 4:
                return Excel::download(new PartenaireVisitesExport, 'PartenaireVisit.csv', \Maatwebsite\Excel\Excel::CSV);
            case 5:
                return Excel::download(new BadgesExport, 'Badges.csv', \Maatwebsite\Excel\Excel::CSV);
            case 6:
                return Excel::download(new UserExport, 'Users.csv', \Maatwebsite\Excel\Excel::CSV);
        }
    }
}
