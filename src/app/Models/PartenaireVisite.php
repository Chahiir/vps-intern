<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartenaireVisite extends Model
{
    use HasFactory;

    protected $fillable = ['motif', 'entrer', 'sortie', 'badge_id', 'partenaire_id'];

    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }

    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class);
    }
}
