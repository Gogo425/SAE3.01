<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public $table = 'status';

    protected $fillable = ['id_status', 'description'];

    public $primary_key = 'id_status';
    public $incrementing = true;
    public $timestamps = false;

}
