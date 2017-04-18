<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Repositories\VehicleRepository;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class VehiclesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VehicleRepository $vehicleRepo)
    {
        $this->middleware('auth');
        $this->vehicleRepo = $vehicleRepo;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search['q'] = request('q');

    	$vehicles = $this->vehicleRepo->findAll($search);

        return view('vehicles.index',compact('vehicles','search'));
    }

     /**
     * Mostrar vista crear usuario
     */
    public function create()
    {
        
        return view('vehicles.create');

    }

     /**
     * save Paciente
     */
    public function store(VehicleRequest $request)
    {
      
        $vehicle = $this->vehicleRepo->store($request->all());
        
        flash('Vehicle saved','success');

         logInfo(auth()->user(), 'Se creó el vehiculo #'. $vehicle->id.', nombre: '. $vehicle->name.', conductor: '.$vehicle->driver);

        return redirect('/vehicles');

    }

     /**
     * Mostrar vista editar usuario
     */
    public function edit($id)
    {
        
        $vehicle = $this->vehicleRepo->findById($id);

       
        return view('vehicles.edit', compact('vehicle'));

    }

    /**
     * Actualizar Paciente
     */
    public function update($id, VehicleRequest $request)
    {
      
        $vehicle = $this->vehicleRepo->update($id, $request->all());
        
        flash('Vehicle saved','success');

         logInfo(auth()->user(), 'Se actualizó el vehiculo #'. $vehicle->id.', nombre: '. $vehicle->name.', conductor: '.$vehicle->driver);

        return back();

    }

     /**
     * Eliminar user
     */
    public function destroy($id)
    {

        $vehicle = $this->vehicleRepo->delete($id);

        flash('Vehicle Deleted','success');

        //logInfo(auth()->user(), 'Se eliminó el vehiculo #'. $id);


        return back();

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getVehicles()
    {
       //if(! request('q')) return [];

       $vehicles =  Vehicle::select('name','id','maximum_capacity')->get(); //Vehicle::Search(request('q'))->pluck('name')->all();
     
       return $vehicles;
    
    
    }
    
}
