<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $filliable = ['id_usertype', 'id', 'id_learn'];

    public function user(){
        return $this->belongsTo(Person::class);
    }

}
