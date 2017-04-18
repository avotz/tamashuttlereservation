<?php namespace App\Repositories;



use App\Vehicle;

class VehicleRepository extends DbRepository{


    /**
     * Construct
     * @param User $model
     */
    function __construct(Vehicle $model)
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
       
        $vehicle = $this->model->create($data);
        
        return $vehicle;
    }

    /**
     * Update a user
     * @param $id
     * @param $data
     * @return \Illuminate\Support\Collection|static
     */
    public function update($id, $data)
    {
        $vehicle = $this->model->findOrFail($id);
        $data = $this->prepareData($data);

        $vehicle->fill($data);
        
        $vehicle->save();


        return $vehicle;
    }

    

    /**
     * Find all the users for the admin panel
     * @internal param $vehiclename
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
            $vehicles = $this->model->Search($search['q']);
        } else
        {
            $vehicles = $this->model;
        }



        if (isset($search['order']) && $search['order'] != "")
        {
            $order = $search['order'];
        }
        if (isset($search['dir']) && $search['dir'] != "")
        {
            $dir = $search['dir'];
        }


        return $vehicles->orderBy('vehicles.'.$order , $dir)->paginate($this->limit);

    }


     /**
     * Delete user
     * @param $id
     * @param $data
     * @return \Illuminate\Support\Collection|static
     */
    public function delete($id)
    {
        
        $vehicle = $this->model->findOrFail($id);

        $res = $vehicle->delete();


         logInfo(auth()->user(), 'Se eliminó el vehiculo #'. $vehicle->id.', nombre: '. $vehicle->name.', conductor: '.$vehicle->driver);
     
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