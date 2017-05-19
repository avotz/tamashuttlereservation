<?php namespace App\Repositories;

use App\Hotel;






class HotelRepository extends DbRepository{


    /**
     * Construct
     * @param User $model
     */
    function __construct(Hotel $model)
    {
        $this->model = $model;
        $this->limit = 10;
    }

    /**
     * save a user
     * @param $data
     */
    public function store($data)
    {
        
        $data = $this->prepareData($data);
       
        $hotel = $this->model->create($data);
        
        return $hotel;
    }

    /**
     * Update a user
     * @param $id
     * @param $data
     * @return \Illuminate\Support\Collection|static
     */
    public function update($id, $data)
    {
        $hotel = $this->model->findOrFail($id);
        $data = $this->prepareData($data);

        $hotel->fill($data);
        
        $hotel->save();


        return $hotel;
    }

    

    /**
     * Find all the users for the admin panel
     * @internal param $hotelname
     * @param null $search
     * @return mixed
     */
    public function findAll($search = null)
    {
        $order = 'created_at';
        $dir = 'desc';

        if (! count($search) > 0) return $this->model->paginate($this->limit);

        if (trim($search['q']))
        {
            $hotels = $this->model->Search($search['q']);
        } else
        {
            $hotels = $this->model;
        }



        if (isset($search['order']) && $search['order'] != "")
        {
            $order = $search['order'];
        }
        if (isset($search['dir']) && $search['dir'] != "")
        {
            $dir = $search['dir'];
        }


        return $hotels->orderBy('hotels.'.$order , $dir)->paginate($this->limit);

    }


     /**
     * Delete user
     * @param $id
     * @param $data
     * @return \Illuminate\Support\Collection|static
     */
    public function delete($id)
    {
        
        $hotel = $this->model->findOrFail($id);

        $res =  $hotel->delete();

        logInfo(auth()->user(), 'Se eliminó el hotel #'. $hotel->id.', nombre: '. $hotel->name);
     
        return $res;
    }



    private function prepareData($data)
    {
       /* if(empty($data['password']))
           return $data = array_except($data, array('password'));

        $data['password'] = bcrypt($data['password']);*/

        return $data;
    }


}