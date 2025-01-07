<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $fillable = ['id_usertype', 'id', 'id_learn'];

    public function user(){
        return $this->belongsTo(persons::class);
    }

}
