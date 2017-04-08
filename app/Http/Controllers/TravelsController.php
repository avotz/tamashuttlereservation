<?php

namespace App\Http\Controllers;


use App\Repositories\TravelRepository;
use Illuminate\Http\Request;

class TravelsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TravelRepository $travelRepo)
    {
        $this->middleware('auth');
        $this->travelRepo = $travelRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travels = $this->travelRepo->findAll();
        //dd($Travels);
        return view('home',compact('travels'));
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
