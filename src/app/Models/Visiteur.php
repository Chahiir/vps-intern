<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visiteur extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'cin', 'entreprise', 'motif', 'entrer', 'sortie', 'badge_id'];

    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }
}
