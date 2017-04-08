<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    
    protected $fillable = ['notes','status'];
    

     /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class);
    }

    /**
     * Assign the given role to the user.
     *
     * @param  string $role
     * @return mixed
     */
    public function assignVehicle($vehicle)
    {
        if (is_object($vehicle)) {
            return $this->vehicles()->attach($vehicle);
       
        }
       
        return $this->vehicles()->sync($vehicle);
       
    }

    /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function hasVehicle($vehicle)
    {
        if (is_string($vehicle)) {
            return $this->vehicles->contains('id', $vehicle);
        }

        return !! $vehicle->intersect($this->vehicles)->count();
    }
    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class);
    }

    /**
     * Assign the given role to the user.
     *
     * @param  string $role
     * @return mixed
     */
    public function assignReservation($reservation)
    {
        if (is_object($reservation)) {
            return $this->reservations()->attach($reservation);
       
        }
       
        return $this->reservations()->sync($reservation);
       
    }

    /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function hasReservation($reservation)
    {
        if (is_string($reservation)) {
            return $this->reservations->contains('id', $reservation);
        }

        return !! $reservation->intersect($this->reservations)->count();
    }
}
