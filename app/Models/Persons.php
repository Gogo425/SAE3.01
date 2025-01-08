<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persons extends Model 
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'PERSONS';
    protected $fillable = ['id', 'name', 'surname', 'password', 'email', 'licence_number','medical_certificate_date', 'birth_date', 'adress'];

}
