<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
class tbl_rooms extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tbl_rooms';
    protected $fillable = [
        'id', 'ma_phong', 'image', 'image2', 'image3', 'type','amount', 'price', 'describe', 'created_at'
    ];
}

