<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUrgence extends Model
{
    use HasFactory;
    protected $fillable = ['nom_contact','phone_contact','lien_familiale','salarier_id'];

    public function salarier()
    {
        return $this->belongsTo(Salarier::class, 'salarier_id');
    }
}
