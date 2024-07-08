<?php

namespace App\Exports;

use App\Models\Badge;
use Maatwebsite\Excel\Concerns\FromCollection;

class BadgesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Badge::select('reference','taken','badge_types.name')->leftJoin('badge_types', 'badges.type_id', '=', 'badge_types.id')->get();
    }


    public function headings(): array
    {
        return [
            'Reference',
            'Taken',
            'Type',
        ];
    }
}
