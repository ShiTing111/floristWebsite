<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBouquet extends Model
{
    use HasFactory;
    protected $table = 'bouquet_order';

    protected $fillable = ['order_id', 'bouquet_id', 'quantity'];
}
