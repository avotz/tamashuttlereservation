<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = ['name','type','status'];

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search)
        {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }
    public function scopeType($query, $search)
    {
        return $query->where(function ($query) use ($search)
        {
            $query->where('type', '=',  $search);
        });
    }
}
