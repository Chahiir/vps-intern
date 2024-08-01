<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable =['name'];

    public function contratTypes()
    {
        return $this->belongsToMany(ContratTypes::class, 'contrat_type_document');
    }

    public function salarie()
    {
        return $this->belongsToMany(Salarier::class, 'salarie_document')->withPivot('file_path');
    }
}
