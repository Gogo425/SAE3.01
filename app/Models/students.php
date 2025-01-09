<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $filliable = ['id_per', 'id_level', 'id_formation'];

    public function user(){
        return $this->belongsTo(Persons::class);
    }

}
