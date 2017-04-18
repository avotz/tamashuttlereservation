<?php namespace App\Repositories;


use App\Role;
use App\User;

class UserRepository extends DbRepository{


    /**
     * Construct
     * @param User $model
     */
    function __construct(User $model)
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
       
        $user = $this->model->create($data);

        $role = (isset($data['role'])) ? $data['role'] : Role::whereName('agent')->first();
        
        $user->assignRole($role);
        
        return $user;
    }

    /**
     * Update a user
     * @param $id
     * @param $data
     * @return \Illuminate\Support\Collection|static
     */
    public function update($id, $data)
    {
        $user = $this->model->findOrFail($id);
        $data = $this->prepareData($data);

        $user->fill($data);

         if(isset($data['role']))
            $user->assignRole($data['role']);
        
        $user->save();


        return $user;
    }

    

    /**
     * Find all the users for the admin panel
     * @internal param $username
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
            $users = $this->model->Search($search['q']);
        } else
        {
            $users = $this->model;
        }

        if (isset($search['role']) && $search['role'] != "")
        {
            $users = $users->whereHas('roles', function ($query) use ($search) {
                        $query->where('name',  $search['role']);
                    });
            
        }

        if (isset($search['order']) && $search['order'] != "")
        {
            $order = $search['order'];
        }
        if (isset($search['dir']) && $search['dir'] != "")
        {
            $dir = $search['dir'];
        }


        return $users->orderBy('users.'.$order , $dir)->paginate($this->limit);

    }


     /**
     * Delete user
     * @param $id
     * @param $data
     * @return \Illuminate\Support\Collection|static
     */
    public function delete($id)
    {
        
        $user = $this->model->findOrFail($id);

        $res = $user->delete();

        logInfo(auth()->user(), 'Se eliminó el usuario #'. $user->id.', nombre: '. $user->name.', roles: '.$user->roles);
     
        return $res;
    }



    private function prepareData($data)
    {
        if(empty($data['password']))
           return $data = array_except($data, array('password'));

        $data['password'] = bcrypt($data['password']);

        return $data;
    }


}