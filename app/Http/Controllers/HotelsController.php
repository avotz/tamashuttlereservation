<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Http\Requests\HotelRequest;
use App\Repositories\HotelRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HotelsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HotelRepository $hotelRepo)
    {
        $this->middleware('auth');
        $this->hotelRepo = $hotelRepo;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search['q'] = request('q');

    	$hotels = $this->hotelRepo->findAll($search);

        return view('hotels.index',compact('hotels','search'));
    }

     /**
     * Mostrar vista crear usuario
     */
    public function create()
    {
       
        return view('hotels.create');

    }

     /**
     * save Paciente
     */
    public function store(HotelRequest $request)
    {
      
        $hotel = $this->hotelRepo->store($request->all());
        
        flash('Hotel saved','success');

         logInfo(auth()->user(), 'Se creó el hotel #'. $hotel->id.', nombre: '. $hotel->name);

        return redirect('/hotels');

    }

     /**
     * Mostrar vista editar usuario
     */
    public function edit($id)
    {
        
        $hotel = $this->hotelRepo->findById($id);

       
        return view('hotels.edit', compact('hotel'));

    }

    /**
     * Actualizar Paciente
     */
    public function update($id, HotelRequest $request)
    {
      
        $hotel = $this->hotelRepo->update($id, $request->all());
        
        flash('Hotel saved','success');

        logInfo(auth()->user(), 'Se actualizó el hotel #'. $hotel->id.', nombre: '. $hotel->name);

        return back();

    }

     /**
     * Eliminar user
     */
    public function destroy($id)
    {

        $hotel = $this->hotelRepo->delete($id);

        flash('Hotel Deleted','success');

        //logInfo(auth()->user(), 'Se eliminó el destino #'. $id);

        return back();

    }

    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getHotels()
    {
       if(! request('q')) return [];

       $hotels = Hotel::Search(request('q'))->get()->all();
     
       return $hotels;
    
    
    }
    
}
