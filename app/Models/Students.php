<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;

class Students extends Model 
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'students';
    protected $fillable = ['id_per','id_level','id_formation'];


}
