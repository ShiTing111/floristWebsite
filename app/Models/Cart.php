<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bouquet;

class Cart extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'quantity',
        'totalPrice',
        'bouquet_id',
        'user_id',
    ];
   
    public function bouquet() {
        return $this->belongsTo(Bouquet::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }


    


}
