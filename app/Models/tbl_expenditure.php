<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
class tbl_expenditure extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tbl_expenditure';
    protected $fillable = [
        'id', 'name', 'type', 'price', 'quantity', 'content','created_at'
    ];
}

