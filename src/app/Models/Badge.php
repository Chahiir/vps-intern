<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = ['reference', 'taken', 'type_id'];

    public function type()
    {
        return $this->belongsTo(BadgeType::class, 'type_id');
    }

    public function visiteurs()
    {
        return $this->hasMany(Visiteur::class);
    }

    public function partenaireVisiteurs()
    {
        return $this->hasMany(PartenaireVisite::class);
    }

    public function salarier()
    {
        return $this->hasMany(Salarier::class);
    }
}
