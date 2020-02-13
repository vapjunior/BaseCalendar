<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Barber;
use App\Service;
use App\User;
use App\Appointment;
use Auth;
use Illuminate\Support\Facades\App;
use Response;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function calendar()
    {
        return view('user-calendar');
    }

    public function barbers()
    {
        $barbers = Barber::where('role',1)->get();

        return view('user-barbers', ['barbers' => $barbers]);
    }

    public function commitcalendar($barber)
    {
        $barber = Barber::find($barber);
        $services = Service::select('services.id','services.name','services.description','services.value')
                            ->get();

        return view('user-calendar-commit', ['barber'=>$barber,'services'=>$services]);
    }

    public function storecalendar(Request $request)
    {
        $servicetime = Service::where('id',$request->service_id)
                                ->select('time')
                                ->get();

        $servicetime = $servicetime[0]->time;

        $start = $request->time;
        $end = date('H:i', strtotime('+' . $servicetime . ' minutes', strtotime($start)));

        $client_id = Auth::user()->id;

        $testcalendar = DB::select("select count(1) as total from appointment
                                        where date = ?
                                          and barbers_id = ?
                                          and ((time >= ? and time < ?) or (time_final > ? and time_final < ?))", [$request->date,$request->barber_id,$start,$end,$start,$end]);
        $testcalendar = $testcalendar[0]->total;
        //dd($testcalendar);
        if ($testcalendar > 0)
        {
            return Response::json(array(
                'success' => false,
                'error' => 'Horário indisponível'
            ), 400);
        }
        else
        {
            $calendar = Appointment::create([
                'date' => $request->date,
                'time' => $request->time,
                'time_final' => $end,
                'barbers_id' => $request->barber_id,
                'service_id' => $request->service_id,
                'client_id' => $client_id
            ]);

            return Response::json(array(
                'success' => true
            ), 200);
        }
    }

    public function listcalendar()
    {
        $calendar = Appointment::where('client_id',Auth::user()->id)
                                ->select('appointment.id','appointment.date','appointment.time','barbers.name as barber','services.name as service','services.value as value')
                                ->join('barbers','appointment.barbers_id','=','barbers.id')
                                ->join('services','appointment.service_id','=','services.id')
                                ->orderBy('date','ASC')
                                ->get();

        // dd($calendar);

        return view('user-calendar',['calendar'=>$calendar]);
    }

    public function allcalendar(Request $request)
    {
        $columns = array(
            0 =>'date',
            1 =>'time',
            2 =>'value',
            3 =>'barber',
            4 =>'service',
            5 =>'options'
        );

        $totalData = Appointment::where('client_id',Auth::user()->id)
                ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {

            $posts = Appointment::where('client_id',Auth::user()->id)
                ->select('appointment.id','appointment.date','appointment.time','barbers.name as barber','services.name as service','services.value as value')
                ->join('barbers','appointment.barbers_id','=','barbers.id')
                ->join('services','appointment.service_id','=','services.id')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

        }
        else {
            $search = $request->input('search.value');

            $posts = Appointment::where('client_id',Auth::user()->id)
                ->where('appointment.date','LIKE',"%{$search}%")
                ->orWhere('appointment.time','LIKE',"%{$search}%")
                ->orWhere('barbers.name','LIKE',"%{$search}%")
                ->orWhere('clients.name','LIKE',"%{$search}%")
                ->orWhere('services.description','LIKE',"%{$search}%")
                ->orWhere('services.value','LIKE',"%{$search}%")
                ->select('appointment.date', 'appointment.time', 'barbers.name as barber', 'clients.name as client', 'services.description as service', 'services.value as value')
                ->join('clients', 'appointment.client_id', '=', 'clients.id')
                ->join('services', 'appointment.service_id', '=', 'services.id')
                ->join('barbers', 'appointment.barbers_id', '=', 'barbers.id')
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Appointment::where('client_id',Auth::user()->id)
                ->where('appointment.date','LIKE',"%{$search}%")
                ->orWhere('appointment.time','LIKE',"%{$search}%")
                ->orWhere('barbers.name','LIKE',"%{$search}%")
                ->orWhere('clients.name','LIKE',"%{$search}%")
                ->orWhere('services.description','LIKE',"%{$search}%")
                ->orWhere('services.value','LIKE',"%{$search}%")
                ->join('clients', 'appointment.client_id', '=', 'clients.id')
                ->join('services', 'appointment.service_id', '=', 'services.id')
                ->join('barbers', 'appointment.barbers_id', '=', 'barbers.id')
                ->count();
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $edit =  route('user.calendar.update',$post->id);
                $delete =  route('user.calendar.delete',$post->id);

                $nestedData['date'] = date('d/m/Y',strtotime($post->date));
                $nestedData['time'] = $post->time;
                $nestedData['value'] = $post->value;
                $nestedData['barber'] = $post->barber;
                $nestedData['service'] = $post->service;
                $nestedData['options'] = "&emsp;<a href='{$edit}' title='SHOW' ><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>
                                          &emsp;<a href='{$delete}' title='EDIT' ><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a>";
                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function editcalendar($id){
        
        // $appointment = Appointment::find($id);
        $calendar = Appointment::where('appointment.id', $id)
                        ->select('appointment.id as appointment_id','appointment.date','appointment.time','appointment.barbers_id','appointment.service_id','barbers.name as barber','services.description as service','services.value as value')
                        ->join('barbers','appointment.barbers_id','=','barbers.id')
                        ->join('services','appointment.service_id','=','services.id')
                        ->get();

        $barber = $calendar[0]['attributes']['barbers_id'];

        $services = Service::where('barbers_id',$barber)
                            ->select('services.id','services.name','services.description','services.value')
                            ->get();
        
        $date = explode(" ", $calendar[0]['attributes']['date']);

        return view('user-calendar-edit', ['calendar'=>$calendar[0],'date'=>$date[0],'services'=>$services]);
    }

    public function updatecalendar(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->service_id = $request->service_id;
        $appointment->save();

        return redirect()->route('user.calendar');
    }

    public function destroycalendar($id)
    {
        $appointment = Appointment::find($id);
        $appointment->delete();
        session()->flash('message','Excluido com Sucesso!');
        return redirect()->route('user.calendar');
    }
}
