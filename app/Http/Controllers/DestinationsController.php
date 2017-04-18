<?php

namespace App\Http\Controllers;


use App\Destination;
use App\Http\Requests\DestinationRequest;
use App\Repositories\DestinationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DestinationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DestinationRepository $destinationRepo)
    {
        $this->middleware('auth');
        $this->destinationRepo = $destinationRepo;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search['q'] = request('q');

    	$destinations = $this->destinationRepo->findAll($search);

        return view('destinations.index',compact('destinations','search'));
    }

     /**
     * Mostrar vista crear usuario
     */
    public function create()
    {
        
        return view('destinations.create');

    }

     /**
     * save Paciente
     */
    public function store(DestinationRequest $request)
    {
      
        $destination = $this->destinationRepo->store($request->all());
        
        flash('Vehicule saved','success');

         logInfo(auth()->user(), 'Se creó el destino #'. $destination->id.', nombre: '. $destination->name);

        return redirect('/destinations');

    }

     /**
     * Mostrar vista editar usuario
     */
    public function edit($id)
    {
        
        $destination = $this->destinationRepo->findById($id);

       
        return view('destinations.edit', compact('destination'));

    }

    /**
     * Actualizar Paciente
     */
    public function update($id, DestinationRequest $request)
    {
      
        $destination = $this->destinationRepo->update($id, $request->all());
        
        flash('Destination saved','success');

        logInfo(auth()->user(), 'Se actualizó el destino #'. $destination->id.', nombre: '. $destination->name);

        return back();

    }

     /**
     * Eliminar user
     */
    public function destroy($id)
    {

        $destination = $this->destinationRepo->delete($id);

        flash('Destination Deleted','success');

        //logInfo(auth()->user(), 'Se eliminó el destino #'. $id);

        return back();

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDestinations()
    {
       if(! request('q')) return [];

       $destinations = Destination::Type(request('type'))->Search(request('q'))->pluck('name')->all();
     
       return $destinations;
    
    
    }
    
}
