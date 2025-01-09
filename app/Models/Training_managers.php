<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training_managers extends Model
{

    use HasFactory;

    protected $table = 'training_managers';
    protected $primaryKey = 'ID_PER';
    protected $fillable = ['id_per'];

    public function user(){
        return $this->belongsTo(Training_managers::class);
    }

    public $timestamps = false;
}
