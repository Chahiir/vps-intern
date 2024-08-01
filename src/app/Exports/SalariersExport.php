<?php
namespace App\Exports;

use App\Models\Salarier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class SalariersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Salarier::select('nom', 'prenom', 'cin', 'adresse', 'cnss', 'situation_familiale', 'date_naissance', 'date_exp_cin',
        'n_assurer', 'date_exp_rma', 'fonction', 'services.name as service_name', 'n_enfant_charge', 'phone', 'puk', 'nature_depart', 'sexe',
        'categorie', 'contrat_type', 'date_debut', 'date_fin', 'badges.reference as badge_reference')
        ->leftJoin('badges', 'salariers.badge_id', '=', 'badges.id')
        ->leftJoin('services','salariers.service_id','=','services.id')
        ->get()
        ->map(function($salarier) {
            // Calculate anciennete
            $dateDebut = Carbon::parse($salarier->date_debut);
            $anciennete = $dateDebut->diff(now());

            $seniorityString = '';

                    if ($anciennete->y > 0) {
                        $seniorityString .= $anciennete->y . ' Ans ';
                    }
                    if ($anciennete->m > 0) {
                        $seniorityString .= $anciennete->m . ' Mois ';
                    }
                    if ($anciennete->d > 0) {
                        $seniorityString .= $anciennete->d . ' Jours';
                    }

            // Calculate age
            $dateNaissance = Carbon::parse($salarier->date_naissance);
            $age = $dateNaissance->diffInYears(now());

            // Add calculated columns
            $salarier->anciennete = $seniorityString;
            $salarier->age = $age;

            return $salarier;
        });
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
            'Date Expiration CIN',
            'N Assurer',
            'Date Expiration RMA',
            'Fonction',
            'Service',
            'N Enfant Charge',
            'Phone',
            'PUK',
            'Nature Depart',
            'Sexe',
            'Categorie',
            'Contrat Type',
            'Date Debut',
            'Date Fin',
            'Badge',
            'Anciennete',  // New column
            'Age'          // New column
        ];
    }
}
