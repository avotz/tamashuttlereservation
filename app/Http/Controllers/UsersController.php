<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('auth');
        $this->userRepo = $userRepo;

        View::share('roles', Role::all());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->hasRole('admin') && !auth()->user()->hasRole('subadmin')) return redirect('/');

        $search['q'] = request('q');
        $search['role'] = request('role');

    	$users = $this->userRepo->findAll($search);

        return view('users.index',compact('users','search'));
    }

     /**
     * Mostrar vista crear usuario
     */
    public function create()
    {
        if(!auth()->user()->hasRole('admin') && !auth()->user()->hasRole('subadmin')) return redirect('/');

        return view('users.create');

    }

     /**
     * save Paciente
     */
    public function store(UserRequest $request)
    {
      
        $user = $this->userRepo->store($request->all());
        
        flash('User saved','success');

        return redirect('/users');

    }

     /**
     * Mostrar vista editar usuario
     */
    public function edit($id)
    {
        if(!auth()->user()->hasRole('admin') && !auth()->user()->hasRole('subadmin')) return redirect('/');
        
        $user = $this->userRepo->findById($id);

       
        return view('users.edit', compact('user'));

    }

    /**
     * Actualizar Paciente
     */
    public function update($id, UserEditRequest $request)
    {
      
        $user = $this->userRepo->update($id, $request->all());
        
        flash('User saved','success');

        return back();

    }

     /**
     * Eliminar user
     */
    public function destroy($id)
    {

        $user = $this->userRepo->delete($id);

        flash('User Deleted','success');

        return back();

    }
    
}
