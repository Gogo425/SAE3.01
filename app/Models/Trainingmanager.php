<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainingmanager extends Model
{
    use HasFactory;
    protected $table = 'training_managers';
    protected $filliable = ['id_usertype'];

    public function user(){
        return $this->belongsTo(Person::class);
    }
}
