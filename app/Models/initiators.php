<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class initiators extends Model
{
    use HasFactory;

    protected $table = 'initiators';
    protected $filliable = ['id_usertype', 'id'];

    public function user(){
        return $this->belongsTo(persons::class);
    }
}
