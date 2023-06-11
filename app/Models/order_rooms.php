<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
class order_rooms extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'order_rooms';
    protected $fillable = [
        'id', 'name', 'phone', 'ma_phong', 'stayNights', 'totalPrice', 'user_id', 'price', 'check_in', 'check_out', 'status'
    ];
}