<?php

namespace App\Http\Controllers;


use App\Repositories\TravelRepository;
use App\Repositories\VehicleRepository;
use App\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TravelsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TravelRepository $travelRepo, VehicleRepository $vehicleRepo)
    {
        $this->middleware('auth');
        $this->travelRepo = $travelRepo;
        $this->vehicleRepo = $vehicleRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request()->all();
        $search['date'] =(trim(request('date')) != '') ? request('date') : Carbon::now()->toDateTimeString();
        
        $travels = $this->travelRepo->findAll($search);
        //$vehicles = $this->vehicleRepo->findAll();
        $vehicles =  Vehicle::select('name','id','maximum_capacity')->get();
      
        return view('home',compact('travels','vehicles','search'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTravels()
    {
        
        $travels = $this->travelRepo->getAll(request()->all());
        
        return $travels;
    }
   

    public function store()
    {
        //dd(request()->all());
        $travel = $this->travelRepo->store(request()->all());

        return $travel;
    }

    /**
     * Actualizar reservacion
     */
    public function update($id)
    {
      
        $travel = $this->travelRepo->update($id, request()->all());
        
       

        return  $travel;

    }

     /**
     * Eliminar user
     */
    public function destroy($id)
    {

        $travel = $this->travelRepo->delete($id);

        

        return '';

    }
}
