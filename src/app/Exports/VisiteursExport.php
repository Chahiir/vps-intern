<?php

namespace App\Exports;

use App\Models\Visiteur;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class VisiteursExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Visiteur::select('nom','prenom','cin','entreprise','motif','entrer','sortie','badges.reference as badge_reference')->leftJoin('badges', 'visiteurs.badge_id', '=', 'badges.id')->get();
    }


    public function headings(): array
    {
        return [
            'Nom',
            'Prenom',
            'CIN',
            'Entreprise',
            'Motif de Visite',
            'Date Entrer',
            'Date Sortie',
            'Badge',
        ];
    }
}
