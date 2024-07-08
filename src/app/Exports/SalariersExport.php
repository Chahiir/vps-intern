<?php

namespace App\Exports;

use App\Models\Salarier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class SalariersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Salarier::select('nom','prenom','cin','adresse','cnss','situation_familiale','date_naissance','contrat_type','date_debut','date_fin','badges.reference as badge_reference')->leftJoin('badges', 'visiteurs.badge_id', '=', 'badges.id')->get();
    }

    public function headings(): array
    {
        return [
            'Nom',
            'Prenom',
            'CIN',
            'Adresse',
            'CNSS',
            'Situation Familiale',
            'Date de Naissance',
            'Type de contrat',
            'Date Debut',
            'Date Fin',
            'Badge'
        ];
    }
}
