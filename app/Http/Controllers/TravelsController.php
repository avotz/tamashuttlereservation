<?php

namespace App\Http\Controllers;


use App\Mail\NewTravel;
use App\Mail\UpdateTravel;
use App\Repositories\TravelRepository;
use App\Repositories\VehicleRepository;
use App\User;
use App\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        $this->administrators = User::whereHas('roles', function ($query){
                        $query->where('name',  'admin');
                    })->get();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request()->all();
        
        $search['date'] =(trim(request('date')) != '') ? request('date') : Carbon::now()->toDateString();
        $search['q'] =(trim(request('q')) != '') ? request('q') : '';
         $search['vehicle'] =(trim(request('vehicle')) != '') ? request('vehicle') : '';
       
        $travels = $this->travelRepo->findAll($search);
        
        //$vehicles = $this->vehicleRepo->findAll();
        $vehicles =  Vehicle::select('name','id','maximum_capacity')->get();
      
        return view('home',compact('travels','vehicles','search'));
    }

     public function export(Excel $excel, Request $request)
    {
        $filters = request()->all();


        \Excel::create('Hojas-de-rutas', function ($excel) use ($filters)
        {

            $excel->sheet('Pla del día', function ($sheet) use ($filters)
            {
                $data = [];

                $travels = $this->travelRepo->reportExcel($filters);

                foreach ($travels as $travel) {
                 
                    $itemArray = [];
                    
                    $itemArray['Vehicle'] = $travel->vehicle . ' '.$travel->maximum_capacity .' PAX';
                    $itemArray['Date'] = ($travel->date == '0000-00-00 00:00:00') ? '' : \Carbon\Carbon::parse($travel->date)->toDateTimeString();
                    $itemArray['From'] = $travel->pickup;
                    $itemArray['To'] = $travel->dropoff;
                    $itemArray['Flight'] = ($travel->flight) ? $travel->flight : '--';
                    $itemArray['Name'] = $travel->customer_name;
                    $itemArray['PAX'] = $travel->adults + $travel->children;
                    $itemArray['Rate'] = $travel->rate;
                    $itemArray['$'] = ($travel->adults + $travel->children) * $travel->rate;
                    $itemArray['Status'] = \Lang::get('utils.status.'. $travel->status);
                    $itemArray['Notes'] = $travel->notes;


                    $data[] = $itemArray;
                }
                   
                            
                
            
                $sheet->fromArray($data, null, 'A1', true);
                $sheet->row(1, function($row) {
                        $row->setFontWeight('bold');
                        $row->setFontSize(13);

                });

            });


        })->export('xls');
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

        logInfo(auth()->user(), 'Se creó un nuevo viaje #'. $travel->id.', reservación: '. $travel->reservations .', vehicle: '. $travel->vehicles  );

        \Mail::to($this->administrators)->send(new NewTravel($travel));

        return $travel;
    }

    /**
     * Actualizar reservacion
     */
    public function update($id)
    {
      
        $travel = $this->travelRepo->update($id, request()->all());
        

         logInfo(auth()->user(), 'Se actualizó el viaje #'. $travel->id.', reservación: '. $travel->reservations .', vehicle: '. $travel->vehicles  );
       
       \Mail::to($this->administrators)->send(new UpdateTravel($travel));

        return  $travel;

    }

     /**
     * Eliminar user
     */
    public function destroy($id)
    {

        $travel = $this->travelRepo->delete($id);

    
        //logInfo(auth()->user(), 'Se eliminó el viaje #'. $id);

        return '';

    }
}
