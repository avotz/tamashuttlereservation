<?php

namespace App\Http\Controllers;


use App\Client;
use App\Destination;
use App\Http\Requests\ClientRequest;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ClientsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ClientRepository $clientRepo)
    {
        $this->middleware('auth');
        $this->clientRepo = $clientRepo;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search['q'] = request('q');

    	$clients = $this->clientRepo->findAll($search);

        return view('clients.index',compact('clients','search'));
    }

     /**
     * Mostrar vista crear usuario
     */
    public function create()
    {
        $destinations = $this->getDestinations();
        //dd($destinations);
        return view('clients.create',compact('destinations'));

    }

     /**
     * save Paciente
     */
    public function store(ClientRequest $request)
    {
      
        $client = $this->clientRepo->store($request->all());
        
        flash('Client saved','success');

         logInfo(auth()->user(), 'Se creó el cliente #'. $client->id.', nombre: '. $client->name);

        return redirect('/clients');

    }

     /**
     * Mostrar vista editar usuario
     */
    public function edit($id)
    {
         $destinations = $this->getDestinations();
        
        $client = $this->clientRepo->findById($id);

       
        return view('clients.edit', compact('client','destinations'));

    }

    /**
     * Actualizar Paciente
     */
    public function update($id, ClientRequest $request)
    {
      
        $client = $this->clientRepo->update($id, $request->all());
        
        flash('Client saved','success');

        logInfo(auth()->user(), 'Se actualizó el destino #'. $client->id.', nombre: '. $client->name);

        return back();

    }

     /**
     * Eliminar user
     */
    public function destroy($id)
    {

        $client = $this->clientRepo->delete($id);

        flash('Client Deleted','success');

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
       //if(! request('q')) return [];


       $destinations = Destination::Search(request('q'))->get()->all();
       
       return $destinations;
    
    
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getClients()
    {
       if(! request('q')) return [];

       $clients = Client::Search(request('q'))->get()->all();
     
       return $clients;
    
    
    }
    
}
