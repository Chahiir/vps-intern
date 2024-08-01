<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteCategorie extends Model
{
    use HasFactory;
    protected $fillable = ['name'];



    public function subCategories()
    {
        return $this->hasMany(NoteSubCategorie::class, 'note_categorie_id');
    }
}
