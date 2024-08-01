<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'cin', 'entreprise'];

    public function visit()
    {
        return $this->hasMany(PartenaireVisite::class);
    }
}
