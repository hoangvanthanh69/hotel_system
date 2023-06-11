<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
class tbl_admin extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tbl_admin';
    protected $fillable = [
        'id', 'admin_email', 'admin_password', 'admin_name', 'position'
    ];
}

