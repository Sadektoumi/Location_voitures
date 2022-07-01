<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    protected $fillable = [
        'Matricule',
        'vehicule_pic',
        'kilometrage',
        'date_mise_en_circulation',
        'price',
        'etat'
    ];
}


