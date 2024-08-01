<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::select('salariers.nom as user_nom', 'salariers.prenom as user_prenom' ,'users.email', 'users.created_at','users.updated_at', 'roles.name as role_name')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->leftJoin('salariers','users.salarier_id','=' , 'salariers.id')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nom ',
            'Prenom',
            'E-mail',
            'Creer le',
            'Modifier le',
            'Role',
        ];
    }

    public function map($user): array
    {
        return [
            $user->user_nom,
            $user->user_prenom,
            $user->email,
            $user->created_at,
            $user->updated_at,
            $user->role_name,
        ];
    }
}
