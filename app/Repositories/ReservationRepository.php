<?php namespace App\Repositories;

use App\Reservation;
use Carbon\Carbon;





class ReservationRepository extends DbRepository{


    /**
     * Construct
     * @param User $model
     */
    function __construct(Reservation $model)
    {
        $this->model = $model;
        $this->limit = 5;
    }

    /**
     * save a user
     * @param $data
     */
    public function store($data)
    {
        
        $data = $this->prepareData($data);
       
        $reservation = $this->model->create($data);
        
        return $reservation;
    }

    /**
     * Update a user
     * @param $id
     * @param $data
     * @return \Illuminate\Support\Collection|static
     */
    public function update($id, $data)
    {
        $reservation = $this->model->findOrFail($id);
        $data = $this->prepareData($data);

        $reservation->fill($data);
        
        $reservation->save();


        return $reservation;
    }

    

    /**
     * Find all the users for the admin panel
     * @internal param $reservationname
     * @param null $search
     * @return mixed
     */
    public function findAll($search = null)
    {
        $order = 'date';
        $dir = 'asc';

        if (! count($search) > 0) return $this->model
                                                    ->orderBy('last_minute', 'desc')
                                                    ->orderBy($order , $dir)
                                                    //->orderBy('time', 'asc')
                                                    ->paginate($this->limit);

        if (isset($search['q']) && trim($search['q']))
        {
            $reservations = $this->model->Search($search['q']);
        } else
        {
            $reservations = $this->model;
        }

        if (isset($search['assigned']) && $search['assigned'] != "")
        {
            
                $reservations =  $reservations->Assigned($search['assigned']);
              
           

        }

        if (isset($search['order']) && $search['order'] != "")
        {
            $order = $search['order'];
        }
        if (isset($search['dir']) && $search['dir'] != "")
        {
            $dir = $search['dir'];
        }


        return $reservations->orderBy('last_minute', 'desc')
                            ->orderBy($order , $dir)
        ->paginate($this->limit);

    }


     /**
     * Delete user
     * @param $id
     * @param $data
     * @return \Illuminate\Support\Collection|static
     */
    public function delete($id)
    {
        
        $reservation = $this->model->findOrFail($id)->delete();
     
        return $reservation;
    }



    private function prepareData($data)
    {
         $timeArray = explode(':', $data['time']);


               $dt = Carbon::parse($data['date']);
               $dt->setTime($timeArray[0], $timeArray[1], 0);
               $data['date'] = $dt;
       
        if(empty($data['children']) || is_null($data['children']))
            $data = array_except($data, array('children'));

        if(empty($data['baby_seat']) || is_null($data['baby_seat']))
            $data = array_except($data, array('baby_seat'));

        if(empty($data['infants']) || is_null($data['infants']))
            $data = array_except($data, array('infants'));

               

        return $data;
    }


}