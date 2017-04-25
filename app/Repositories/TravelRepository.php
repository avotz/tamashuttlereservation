<?php namespace App\Repositories;


use App\Travel;
use Carbon\Carbon;





class TravelRepository extends DbRepository{


    /**
     * Construct
     * @param User $model
     */
    function __construct(Travel $model)
    {
        $this->model = $model;
        $this->limit = 20;
    }

    /**
     * save a user
     * @param $data
     */
    public function store($data)
    {
      
        $data = $this->prepareData($data);
       
        $travel = $this->model->create($data);

        if(isset($data['vehicle']))
            $travel->assignVehicle([$data['vehicle']]);

         if(isset($data['reservations']))
         {
            $idsReservations = array_pluck($data['reservations'], 'id');

            $travel->assignReservation($idsReservations);

             \DB::table('reservations')
            ->whereIn('id', $idsReservations)
            ->update(['assigned' => 1]);
        
         }
        
        return $travel;
    }

    /**
     * Update a user
     * @param $id
     * @param $data
     * @return \Illuminate\Support\Collection|static
     */
    public function update($id, $data)
    {
        $travel = $this->model->findOrFail($id);
        $data = $this->prepareData($data);

        $travel->fill($data);

        if(isset($data['vehicle']))
            $travel->assignVehicle([$data['vehicle']]);

         if(isset($data['reservations']))
         {
            $idsReservations = array_pluck($data['reservations'], 'id');

            $travel->assignReservation($idsReservations);

             \DB::table('reservations')
            ->whereIn('id', $idsReservations)
            ->update(['assigned' => 1]);
        
         }
          if(isset($data['reservationsDeleted']))
         {
            $idsReservations = $data['reservationsDeleted'];

             \DB::table('reservations')
            ->whereIn('id', $idsReservations)
            ->update(['assigned' => 0]);
        
         }
        
        $travel->save();


        return $travel;
    }

    

    /**
     * Find all the users for the admin panel
     * @internal param $travelname
     * @param null $search
     * @return mixed
     */
    public function findAll($search = null)
    {
        $order = 'date';
        $dir = 'asc';
        $travels = $this->model;

        
        
        $travels =  $travels->selectRaw('travels.id as travel_id, reservations.*, vehicles.name as vehicle, vehicles.maximum_capacity')
            ->join('reservation_travel', 'reservation_travel.travel_id', '=', 'travels.id')
            ->join('reservations', 'reservations.id', '=', 'reservation_travel.reservation_id')

            ->join('travel_vehicle', 'travel_vehicle.travel_id', '=', 'travels.id')
             ->join('vehicles', 'vehicles.id', '=', 'travel_vehicle.vehicle_id');
             //->groupBy('travels.id')
            // ->where('vehicles.id','=', $search['vehicle'])
            // ->orderBy('reservations.'.$order, $dir)
            //->get();
        
         if (isset($search['date']) && trim($search['date']))
        {
            
            $travels = $travels->whereDate('reservations.date', $search['date']);
            
        } 
            
         if (isset($search['vehicle']) && trim($search['vehicle']))
        {
            $travels = $travels->where('vehicles.id','=', $search['vehicle']);
        } 

        if (isset($search['q']) && trim($search['q']))
        {
            $travels = $travels->where('reservations.customer_name','like', '%' .$search['q']. '%');
        } 
        
        
        return paginate($travels->orderBy('reservations.'.$order, $dir)->get()->all(), $this->limit);

        /*if (! count($search) > 0) return $this->model->paginate($this->limit);

        if (isset($search['q']) && trim($search['q']))
        {
            $travels = $this->model->Search($search['q']);
        } else
        {
            $travels = $this->model;
        }

       
        if (isset($search['order']) && $search['order'] != "")
        {
            $order = $search['order'];
        }
        if (isset($search['dir']) && $search['dir'] != "")
        {
            $dir = $search['dir'];
        }


        return $travels->orderBy($order , $dir)->paginate($this->limit);*/

    }

    /**
     * Find all the users for the admin panel
     * @internal param $travelname
     * @param null $search
     * @return mixed
     */
    public function reportExcel($search = null)
    {
        $order = 'date';
        $dir = 'asc';
        $travels = $this->model;

        
        
        $travels =  $travels->selectRaw('travels.id as travel_id, reservations.*, vehicles.name as vehicle, vehicles.maximum_capacity')
            ->join('reservation_travel', 'reservation_travel.travel_id', '=', 'travels.id')
            ->join('reservations', 'reservations.id', '=', 'reservation_travel.reservation_id')

            ->join('travel_vehicle', 'travel_vehicle.travel_id', '=', 'travels.id')
             ->join('vehicles', 'vehicles.id', '=', 'travel_vehicle.vehicle_id');
             //->groupBy('travels.id')
            // ->where('vehicles.id','=', $search['vehicle'])
            // ->orderBy('reservations.'.$order, $dir)
            //->get();

         if (isset($search['exp-date']) && trim($search['exp-date']))
        {
            $travels = $travels->whereDate('reservations.date', $search['exp-date']);
           
        } 
            
         if (isset($search['exp-vehicle']) && trim($search['exp-vehicle']))
        {
            $travels = $travels->where('vehicles.id','=', $search['exp-vehicle']);
        } 

        if (isset($search['exp-q']) && trim($search['exp-q']))
        {
            $travels = $travels->where('reservations.customer_name','like', '%' .$search['exp-q']. '%');
        } 
        
        
        return $travels->orderBy('reservations.'.$order, $dir)->get()->all();

    

    }

    /**
     * Find all the users for the admin panel
     * @internal param $reservationname
     * @param null $search
     * @return mixed
     */
    public function getAll($search = null)
    {
        $order = 'created_at';
        $dir = 'asc';

        if (! count($search) > 0) return $this->model->with('reservations','vehicles')->orderBy($order , $dir)
                                                    ->paginate($this->limit);

        if (isset($search['q']) && trim($search['q']))
        {
            $travels = $this->model->Search($search['q']);
        } else
        {
            $travels = $this->model;
        }

        if (isset($search['order']) && $search['order'] != "")
        {
            $order = $search['order'];
        }
        if (isset($search['dir']) && $search['dir'] != "")
        {
            $dir = $search['dir'];
        }


        return $travels->with('reservations','vehicles')->orderBy($order , $dir)->paginate($this->limit);

    }


     /**
     * Delete user
     * @param $id
     * @param $data
     * @return \Illuminate\Support\Collection|static
     */
    public function delete($id)
    {
        
        $travel = $this->model->findOrFail($id);
        $idsReservations =  $travel->reservations->pluck('id');

        $res = $travel->delete();

        \DB::table('reservations')
            ->whereIn('id', $idsReservations)
            ->update(['assigned' => 0]);

        \DB::table('reservation_travel')
            ->where('travel_id', $id)
            ->delete();

        \DB::table('travel_vehicle')
            ->where('travel_id', $id)
            ->delete();

    
        logInfo(auth()->user(), 'Se eliminó el viaje #'. $travel->id.', reservacion: '. $travel->reservations .', vehicle: '. $travel->vehicles  );
       

        return $res;
    }



    private function prepareData($data)
    {
         
               

        return $data;
    }


}