<?php

namespace App\Exports;

use App\Models\Partenaire;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PartenairesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Partenaire::select('nom','prenom','cin','entreprise')->get();
    }


    public function headings(): array
    {
        return [
            'Nom',
            'Prenom',
            'CIN',
            'Entreprise',
        ];
    }
}
