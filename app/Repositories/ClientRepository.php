<?php namespace App\Repositories;

use App\Client;





class ClientRepository extends DbRepository{


    /**
     * Construct
     * @param User $model
     */
    function __construct(Client $model)
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
       
        $client = $this->model->create($data);
        
        return $client;
    }

    /**
     * Update a user
     * @param $id
     * @param $data
     * @return \Illuminate\Support\Collection|static
     */
    public function update($id, $data)
    {
        $client = $this->model->findOrFail($id);
        $data = $this->prepareData($data);

        $client->fill($data);
        
        $client->save();


        return $client;
    }

    

    /**
     * Find all the users for the admin panel
     * @internal param $clientname
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
            $clients = $this->model->Search($search['q']);
        } else
        {
            $clients = $this->model;
        }



        if (isset($search['order']) && $search['order'] != "")
        {
            $order = $search['order'];
        }
        if (isset($search['dir']) && $search['dir'] != "")
        {
            $dir = $search['dir'];
        }


        return $clients->orderBy('clients.'.$order , $dir)->paginate($this->limit);

    }


     /**
     * Delete user
     * @param $id
     * @param $data
     * @return \Illuminate\Support\Collection|static
     */
    public function delete($id)
    {
        
        $client = $this->model->findOrFail($id);

        $res =  $client->delete();

        logInfo(auth()->user(), 'Se eliminó el cliente #'. $client->id.', nombre: '. $client->name);
     
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