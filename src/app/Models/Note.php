<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = ['manager_id','salarie_id','note_sub_categorie_id','note','remarque','annee'];

    public function noteSubCategorie()
    {
        return $this->belongsTo(NoteSubCategorie::class, 'sub_note_categorie_id');
    }

    public function manager()
    {
        return $this->belongsTo(Salarier::class, 'manager_id');
    }

    // Relationship to Salarie
    public function salarie()
    {
        return $this->belongsTo(Salarier::class, 'salarie_id');
    }


}
