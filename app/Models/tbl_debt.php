<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
class tbl_debt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tbl_debt';
    protected $fillable = [
        'id', '	name', 'ma_phong', 'check_in', 'check_out', 'totalPrice'
    ];
}