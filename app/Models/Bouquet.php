<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bouquet extends Model
{
    use HasFactory;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'size',
        'image',
    ];

    public function getBouquetImages()
    {
        //One to many relationship
        return $this->hasMany('App\Models\Bouquet_Images');
    }
}
