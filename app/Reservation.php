<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = ['errors','regular_client'];
    
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search)
        {
            $query->where('customer_name', 'like', '%' . $search . '%')
                  ->orWhere('customer_email', 'like', '%' . $search . '%')
                  ->orWhere('customer_phone', 'like', '%' . $search . '%')
                  ->orWhere('pickup', 'like', '%' . $search . '%')
                  ->orWhere('flight', 'like', '%' . $search . '%')
                  ->orWhere('notes', 'like', '%' . $search . '%')
                  ->orWhere('hidden_notes', 'like', '%' . $search . '%');
        });
    }
    public function scopeAssigned($query, $search)
    {
        return $query->where(function ($query) use ($search)
        {
            $query->where('assigned', '=',  $search );

        });
    }
    public function scopeHotel($query, $search)
    {
        return $query->where(function ($query) use ($search)
        {
            $query->where('credit_hotel', 1)
                  ->where('hotel', 'like', '%' . $search . '%');

        });
    }

     /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function travels()
    {
        return $this->belongsToMany(Travel::class);
    }
}
