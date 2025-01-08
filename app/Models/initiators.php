<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Initiators extends Model
{
    use HasFactory;

    protected $table = 'initiators';
    protected $primaryKey = 'ID_PER';
    protected $fillable = ['id_per', 'id_level'];
    
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(Persons::class);
    }
}
