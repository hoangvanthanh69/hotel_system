<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
class tbl_service extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tbl_service';
    protected $fillable = [
        'id', 'type_service', 'name_service', 'price_service', 'note_service'
    ];
}

