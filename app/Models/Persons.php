<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticable as BasicAuthenticable;

class Persons extends Model
{
    use HasFactory;


    protected $table = 'persons';
    protected $fillable = ['name', 'surname', 'password', 'mail_adress', 'licence_number','medical_certificate_date', 'birth_date', 'adress'];

}
