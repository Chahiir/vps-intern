<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadgeType extends Model
{
    use HasFactory;

    protected $fillable=['name'];

    public function badges()
    {
        return $this->hasMany(Badge::class, 'type_id');
    }
}
