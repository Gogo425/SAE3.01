<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trainingmanagers extends Model
{
    use HasFactory;
    protected $table = 'training_managers';
    protected $fillable = ['id_usertype'];

    public function user(){
        return $this->belongsTo(persons::class);
    }
}
