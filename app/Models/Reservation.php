<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable =[

        'etat',
        'date_deb',
        'date_fin',
        'vehicule_id',
        'name',
        'lastname',
        'phone',
        'cin',
        'user_id'

    ];

    public function vehicule(){
        return $this->hasOne(Vehicule::class, 'id', 'vehicule_id');
    }
    public function users(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
