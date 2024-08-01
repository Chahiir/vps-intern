<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salarier extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'cin', 'date_naissance', 'adresse', 'contrat_type', 'date_debut', 'date_fin', 'cnss', 'situation_familiale',
        'date_exp_cin',
        'n_assurer',
        'date_exp_rma',
        'fonction',
        'service_id',
        'n_enfant_charge',
        'phone',
        'puk',
        'nature_depart',
        'sexe',
        'categorie',
        'manager_id',
        'is_manager'
    ];

    protected $dates = ['date_debut', 'date_naissance'];

    protected $casts = [
        'date_debut' => 'date',
        'date_naissance' => 'date',
    ];

    public function manager()
    {
        return $this->belongsTo(Salarier::class, 'manager_id');
    }

    public function subordinates()
    {
        return $this->hasMany(Salarier::class, 'manager_id');
    }

    public function type()
    {
        return $this->belongsTo(ContratTypes::class, 'contrat_type');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }

    public function contactUrgences()
    {
        return $this->hasMany(ContactUrgence::class, 'salarier_id');
    }
    public function user()
    {
        return $this->hasOne(User::class,'salarier_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'salarie_id');
    }
    public function managedNotes()
    {
        return $this->hasMany(Note::class, 'manager_id');
    }

    public function remarques()
    {
        return $this->hasMany(Remarques::class, 'salarie_id');
    }
    public function documents()
    {
        return $this->belongsToMany(Document::class, 'salarie_document')->withPivot('file_path');
    }
}
