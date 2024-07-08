<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salarier extends Model
{
    use HasFactory;

    protected $fillable = ['nom','prenom','cin','date_naissance','adresse','contrat_type','date_debut','date_fin','cnss','situation_familiale'];

    public function type()
    {
        return $this->belongsTo(ContratTypes::class, 'contrat_type');
    }
    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }
}
