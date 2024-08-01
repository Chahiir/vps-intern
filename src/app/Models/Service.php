<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function salariers()
    {
        return $this->hasMany(Salarier::class, 'service_id');
    }

    public function noteSubCategories()
    {
        return $this->belongsToMany(NoteSubCategorie::class, 'note_sub_categorie_service');
    }
}
