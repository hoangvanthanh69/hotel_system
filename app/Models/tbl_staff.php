<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
class tbl_staff extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tbl_staff';
    protected $fillable = [
        'id', 'code_staff', 'name', 'phone', 'cccd', 'address', 'wage'
    ];
}

