<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class utilisateur extends Model
{
    use HasFactory;

    public function reservations()
    {
        return $this->hasMany('App\Models\reservation');
    }
}
