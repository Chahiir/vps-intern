<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratTypes extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function salariers()
    {
        return $this->hasMany(Salarier::class, 'contrat_type');
    }
    
    public function documents()
    {
        return $this->belongsToMany(Document::class, 'contrat_type_document');
    }
}
