<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service;
use App\User;
use App\Appointment;
use App\Barber;
use Auth;
use Response;
use DB;

class BarberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:barber');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('barber');
    }

    public function create()
    {
        return view('barber-barbers-add');
    }

    public function edit($id)
    {
        $barber = Barber::find($id);

        //dd($service);
        return view('barber-barbers-edit', ['barber'=>$barber]);
    }

    public function update(Request $request, $id)
    {
        //dd($request, $id);

        $barber = Barber::find($id);

        $barber->name = $request->name;
        $barber->email = $request->email;
        $barber->phone = $request->phone;
        $barber->role = $request->role;
        $barber->save();

        return redirect()->route('barber.barbers');
    }

    public function destroy($id)
    {
        $barber = Barber::find($id);
        $barber->delete();
        session()->flash('message','Excluido com Sucesso!');
        return redirect()->route('barber.barbers');
    }

    public function calendar()
    {
        return view('barber-calendar');
    }

    public function services()
    {
        return view('barber-services');
    }

    public function listcalendar()
    {
        if (Auth::user()->role == 0) {
            $calendar = Appointment::select('appointment.date','appointment.time','barbers.name as barber','clients.name as client','services.description as service', 'services.value as value')
                                ->join('clients','appointment.client_id','=','clients.id')
                                ->join('services','appointment.service_id','=','services.id')
                                ->join('barbers','appointment.barbers_id','=','barbers.id')
                                ->orderBy('date','ASC')
                                ->get();
        } else {
            $calendar = Appointment::where('appointment.barbers_id',Auth::user()->id)
                                ->select('appointment.date','appointment.time','clients.name as client','services.description as service', 'services.value as value')
                                ->join('clients','appointment.client_id','=','clients.id')
                                ->join('services','appointment.service_id','=','services.id')
                                ->orderBy('date','ASC')
                                ->get();
        }

        return view('barber-calendar',['calendar'=>$calendar]);
    }

    public function allcalendar(Request $request)
    {
        $columns = array(
            0 =>'date',
            1 =>'time',
            2 =>'barber',
            3 =>'client',
            4 =>'service',
            5 =>'value'
        );

        $totalData = Appointment::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {
            if (Auth::user()->role == 0) {
//                $posts = User::offset($start)
//                    ->limit($limit)
//                    ->orderBy($order,$dir)
//                    ->get();

                $posts = Appointment::select('appointment.date as date', 'appointment.time', 'barbers.name as barber', 'clients.name as client', 'services.name as service', 'services.value as value')
                    ->join('clients', 'appointment.client_id', '=', 'clients.id')
                    ->join('services', 'appointment.service_id', '=', 'services.id')
                    ->join('barbers', 'appointment.barbers_id', '=', 'barbers.id')
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            } else {
                $posts = Appointment::where('appointment.barbers_id',Auth::user()->id)
                    ->select('appointment.date as date','appointment.time','clients.name as client','barbers.name as barber','services.name as service', 'services.value as value')
                    ->join('clients','appointment.client_id','=','clients.id')
                    ->join('services','appointment.service_id','=','services.id')
                    ->join('barbers','appointment.barbers_id','=','barbers.id')
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            }
        }
        else {
            $search = $request->input('search.value');

            if (Auth::user()->role == 0) {

                $posts = Appointment::where('appointment.date','LIKE',"%{$search}%")
                    ->orWhere('appointment.time','LIKE',"%{$search}%")
                    ->orWhere('barbers.name','LIKE',"%{$search}%")
                    ->orWhere('clients.name','LIKE',"%{$search}%")
                    ->orWhere('services.name','LIKE',"%{$search}%")
                    ->orWhere('services.value','LIKE',"%{$search}%")
                    ->select('appointment.date', 'appointment.time', 'barbers.name as barber', 'clients.name as client', 'services.name as service', 'services.value as value')
                    ->join('clients', 'appointment.client_id', '=', 'clients.id')
                    ->join('services', 'appointment.service_id', '=', 'services.id')
                    ->join('barbers', 'appointment.barbers_id', '=', 'barbers.id')
                    ->orderBy($order, $dir)
                    ->get();

                $totalFiltered = Appointment::where('appointment.date','LIKE',"%{$search}%")
                    ->orWhere('appointment.time','LIKE',"%{$search}%")
                    ->orWhere('barbers.name','LIKE',"%{$search}%")
                    ->orWhere('clients.name','LIKE',"%{$search}%")
                    ->orWhere('services.name','LIKE',"%{$search}%")
                    ->orWhere('services.value','LIKE',"%{$search}%")
                    ->join('clients', 'appointment.client_id', '=', 'clients.id')
                    ->join('services', 'appointment.service_id', '=', 'services.id')
                    ->join('barbers', 'appointment.barbers_id', '=', 'barbers.id')
                    ->count();
            } else {

                $posts = Appointment::where('appointment.barbers_id',Auth::user()->id)
                    ->where('appointment.date','LIKE',"%{$search}%")
                    ->orWhere('appointment.time','LIKE',"%{$search}%")
                    ->orWhere('barbers.name','LIKE',"%{$search}%")
                    ->orWhere('clients.name','LIKE',"%{$search}%")
                    ->orWhere('services.name','LIKE',"%{$search}%")
                    ->orWhere('services.value','LIKE',"%{$search}%")
                    ->select('appointment.date as date', 'appointment.time', 'barbers.name as barber', 'clients.name as client', 'services.name as service', 'services.value as value')
                    ->join('clients', 'appointment.client_id', '=', 'clients.id')
                    ->join('services', 'appointment.service_id', '=', 'services.id')
                    ->join('barbers', 'appointment.barbers_id', '=', 'barbers.id')
                    ->orderBy($order, $dir)
                    ->get();

                $totalFiltered = Appointment::where('appointment.barbers_id',Auth::user()->id)
                    ->where('appointment.date','LIKE',"%{$search}%")
                    ->orWhere('appointment.time','LIKE',"%{$search}%")
                    ->orWhere('barbers.name','LIKE',"%{$search}%")
                    ->orWhere('clients.name','LIKE',"%{$search}%")
                    ->orWhere('services.name','LIKE',"%{$search}%")
                    ->orWhere('services.value','LIKE',"%{$search}%")
                    ->join('clients', 'appointment.client_id', '=', 'clients.id')
                    ->join('services', 'appointment.service_id', '=', 'services.id')
                    ->join('barbers', 'appointment.barbers_id', '=', 'barbers.id')
                    ->count();
            }
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {

                $nestedData['date'] = date('d/m/Y',strtotime($post->date));
                $nestedData['time'] = $post->time;
                $nestedData['barber'] = $post->barber;
                $nestedData['client'] = $post->client;
                $nestedData['service'] = $post->service;
                $nestedData['value'] = "R$ ".$post->value;
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

    public function listbarbers()
    {
        if (Auth::user()->role == 0) {
            $barbers = Barber::all();
        } else {
            return redirect()->route('barber.calendar');
        }
        
        return view('barber-barbers', ['barbers'=>$barbers]);
    }

    public function listclients()
    {
        if (Auth::user()->role == 0)
            return view('barber-clients');

        return redirect()->route('barber.calendar');
    }

    public function allclients(Request $request)
    {
        $columns = array(
            0 =>'name',
            1 =>'options'
        );

        $totalData = User::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $posts = User::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $posts =  User::where('name','LIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = User::where('name','LIKE',"%{$search}%")
                ->count();
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $calendar = route('barber.clients.calendar',$post->id);
                $edit =  route('barber.clients.update',$post->id);
                $delete =  route('barber.clients.delete',$post->id);

                $nestedData['name'] = $post->name;
                $nestedData['calendar'] = "<a class='btn btn-large btn-warning' href='{$calendar}'>Agendar</a>";
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

    public function commitcalendar($id)
    {
        $client = User::find($id);
        $services = Service::all();
        $barbers = Barber::where('role','1')
                            ->get();

        return view('barber-clients-calendar', ['client'=>$client,'services'=>$services,'barbers'=>$barbers]);
    }

    public function storecalendar(Request $request)
    {
        $servicetime = Service::where('id', $request->service_id)
            ->select('time')
            ->get();

        $servicetime = $servicetime[0]->time;


        $start = $request->time;
        $end = date('H:i', strtotime('+' . $servicetime . ' minutes', strtotime($start)));

        $testcalendar = DB::select("select count(1) as total from appointment
                                        where date = ?
                                          and barbers_id = ?
                                          and ((time >= ? and time < ?) or (time_final > ? and time_final < ?))", [$request->date,$request->barber_id,$start,$end,$start,$end]);
        $testcalendar = $testcalendar[0]->total;

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
                'client_id' => $request->client_id
            ]);

            return Response::json(array(
                'success' => true
            ), 200);
        }

    }

    public function editclients($id)
    {
        if(Auth::user()->role != 0)
            return redirect()->route('barber.clients');

        $client = User::find($id);

        //dd($client);
        return view('barber-clients-edit', ['client'=>$client]);
    }

    public function updateclients(Request $request, $id)
    {
        if(Auth::user()->role != 0)
            return redirect()->route('barber.clients');

        $client = User::find($id);
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->sex = $request->sex;
        $client->birthDate = $request->birthDate;
        $client->save();

        return redirect()->route('barber.clients');
    }

    public function destroyclients($id)
    {
        if (Auth::user()->role != 0)
            return redirect()->route('barber.clients');
        
        $client = User::find($id);
        $client->delete();
        session()->flash('message','Excluido com Sucesso!');
        
        return redirect()->route('barber.clients');
    }

    public function dash()
    {
        if (Auth::user()->role != 0)
            return redirect()->route('barber.calendar');
        
        $date = date('Y-m-d');

        $appointments = Appointment::where('date',$date)
                        ->select('appointment.id','appointment.date','appointment.time','barbers.id as barber_id','barbers.name as barber_name','services.id as service_id','services.name as service_name','services.value','clients.id as client_id','clients.name as client_name')
                        ->join('barbers','appointment.barbers_id','=','barbers.id')
                        ->join('services','appointment.service_id','=','services.id')
                        ->join('clients','appointment.client_id','=','clients.id')
                        ->get();
        
        $total = 0;

        $apBarbers = [];

        foreach ($appointments as $ap) { 
            $total += $ap->value;

            $apBarbers[$ap->barber_id] = Appointment::where('appointment.barbers_id',$ap->barber_id)
                                                        ->select('appointment.id','appointment.date','appointment.time','barbers.id as barber_id','barbers.name as barber_name','services.id as service_id','services.name as service_name','services.value','clients.id as client_id','clients.name as client_name')
                                                        ->join('barbers','appointment.barbers_id','=','barbers.id')
                                                        ->join('services','appointment.service_id','=','services.id')
                                                        ->join('clients','appointment.client_id','=','clients.id')
                                                        ->where('date',$date)
                                                        ->get();
        }

        //dd($apBarber);
        $date = date('d/m/Y');

        return view('barber-admin-dash', ['appointments'=>$appointments,'date'=>$date,'total'=>$total,'apbarber'=>$apBarbers]);
    }
}
