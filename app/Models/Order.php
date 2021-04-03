<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'billing_email', 'billing_name', 'billing_address', 'billing_city',
        'billing_province', 'billing_postalcode', 'billing_phone', 'billing_total',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function bouquets()
    {
        return $this->belongsToMany('App\Models\Bouquet')->withPivot('quantity');
    }
}
