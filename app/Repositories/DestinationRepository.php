<?php namespace App\Repositories;

use App\Destination;



class DestinationRepository extends DbRepository{


    /**
     * Construct
     * @param User $model
     */
    function __construct(Destination $model)
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
       
        $destination = $this->model->create($data);
        
        return $destination;
    }

    /**
     * Update a user
     * @param $id
     * @param $data
     * @return \Illuminate\Support\Collection|static
     */
    public function update($id, $data)
    {
        $destination = $this->model->findOrFail($id);
        $data = $this->prepareData($data);

        $destination->fill($data);
        
        $destination->save();


        return $destination;
    }

    

    /**
     * Find all the users for the admin panel
     * @internal param $destinationname
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
            $destinations = $this->model->Search($search['q']);
        } else
        {
            $destinations = $this->model;
        }



        if (isset($search['order']) && $search['order'] != "")
        {
            $order = $search['order'];
        }
        if (isset($search['dir']) && $search['dir'] != "")
        {
            $dir = $search['dir'];
        }


        return $destinations->orderBy('destinations.'.$order , $dir)->paginate($this->limit);

    }


     /**
     * Delete user
     * @param $id
     * @param $data
     * @return \Illuminate\Support\Collection|static
     */
    public function delete($id)
    {
        
        $destination = $this->model->findOrFail($id);

        $res =  $destination->delete();

        logInfo(auth()->user(), 'Se eliminó el destino #'. $destination->id.', nombre: '. $destination->name);
     
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