<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remarques extends Model
{
    use HasFactory;
    protected $fillable = ['annee','salarie_id','point_fort','point_ameliorer','action','projet','commentaire','note_final'];

    public function salarie()
    {
        return $this->belongsTo(Salarier::class, 'salarie_id');
    }
}
