<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name','description','url','views','rating','image', 'contact_email','phone_number', 'address',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsToMany('App\Category');
    }

    public function image()
    {
        return $this->hasMany('App\Image');
    }

    public function rating()
    {
        return $this->belongsToMany('App\Rating');
    }
}
