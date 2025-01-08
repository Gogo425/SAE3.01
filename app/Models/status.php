<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    protected $fillable = [
        'id_status',
        'description'
    ];

    public $timestamps = false;

    function getDesc($id){
        $desc = status::where('ID_STATUS', $id)->select('DESCRIPTION')->get();
        return $desc;
    }
}
