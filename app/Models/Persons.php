<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;

class Persons extends Model implements Authenticatable
{
    use HasFactory;
    use BasicAuthenticatable;

    public $timestamps = false;

    protected $table = 'PERSONS';
    protected $fillable = ['id', 'name', 'surname', 'password', 'email', 'licence_number','medical_certificate_date', 'birth_date', 'adress'];

    public function getAuthPassword() {
        return $this->PASSWORD;
    }
}
