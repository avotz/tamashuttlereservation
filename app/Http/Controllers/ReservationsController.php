<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Repositories\ReservationRepository;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ReservationRepository $reservationRepo)
    {
        $this->middleware('auth');
        $this->reservationRepo = $reservationRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = $this->reservationRepo->findAll();
        //dd($reservations);
        return view('reservations.index',compact('reservations'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getReservations()
    {
        
        $reservations = $this->reservationRepo->findAll(request()->all());
        
        return $reservations;
    }

    public function store(ReservationRequest $request)
    {
      
        $reservation = $this->reservationRepo->store($request->all());

        logInfo(auth()->user(), 'Se creó la reservación #'. $reservation->id.', fecha: '. $reservation->date .', cliente: '. $reservation->customer_name  );

        return $reservation;
    }

    /**
     * Actualizar reservacion
     */
    public function update($id, ReservationRequest $request)
    {
      
        $reservation = $this->reservationRepo->update($id, $request->all());

       
        logInfo(auth()->user(), 'Se actualizó la reservación #'. $reservation->id.', fecha: '. $reservation->date .', cliente: '. $reservation->customer_name  );

        return  $reservation;

    }

    /**
     * Actualizar reservacion
     */
    public function updateAssigned($id)
    {
      
        $reservation = \DB::table('reservations')
            ->where('id', $id)
            ->update(['assigned' => request('assigned')]);   

        return  $reservation;

    }

    /**
     * Actualizar reservacion
     */
    public function cancel($id)
    {
      
        $reservation = $this->reservationRepo->findById($id);
        $reservation->status = -1;
        $reservation->save();

            logInfo(auth()->user(), 'Se canceló la reservación #'. $reservation->id.', fecha: '. $reservation->date .', cliente: '. $reservation->customer_name  );  

        return  $reservation;

    }
     /**
     * Eliminar user
     */
    public function destroy($id)
    {

        $reservation = $this->reservationRepo->delete($id);

        //logInfo(auth()->user(), 'Se eliminó la reservación #'. $id  );

        return '';

    }
   
}
