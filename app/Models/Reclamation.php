<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    protected $fillable =[
        'user_id',
        'reclamation'

    ];
    public function users(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }


}
