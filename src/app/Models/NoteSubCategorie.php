<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteSubCategorie extends Model
{
    use HasFactory;
    protected $fillable=['name','note_categorie_id'];

    public function categorie()
    {
        return $this->belongsTo(NoteCategorie::class, 'note_categorie_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'note_sub_categorie_service');
    }
}
