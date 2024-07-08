<?php

namespace App\Exports;

use App\Models\PartenaireVisite;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PartenaireVisitesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PartenaireVisite::select('partenaires.nom','partenaires.prenom','partenaires.cin','partenaires.entreprise','motif','entrer','sortie','badges.reference')->leftJoin('badges', 'partenaire_visites.badge_id', '=', 'badges.id')->leftJoin('partenaires','partenaire_visites.partenaire_id','=','partenaires.id')->get();
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
