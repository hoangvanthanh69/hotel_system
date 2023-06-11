<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
class tbl_customer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tbl_customer';
    protected $fillable = [
        'id', 'email', 'password', 'name', 'created_at'
    ];
}

