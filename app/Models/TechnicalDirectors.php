<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalDirectors extends Model
{
    use HasFactory;

    protected $table = 'technical_directors';
    protected $fillable = ['id_per'];
    
    public $timestamps = false;
}