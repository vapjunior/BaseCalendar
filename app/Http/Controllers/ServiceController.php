<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Service;

use App\Barber;

use Auth;

class ServiceController extends Controller
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
        $services = Service::select('services.id','services.name','services.description','services.value','services.time')
                            ->get();
        return view('barber-services',['services' => $services]);
    }

    public function create()
    {
        return view('barber-services-add');
    }

    public function store(Request $request)
    {
        $barber_id = $request->barber_id;

        $service = Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'value' => $request->value,
            'time' => $request->time
        ]);

        return redirect()->route('barber.services');
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();
        session()->flash('message','Excluido com Sucesso!');
        return redirect()->route('barber.services');
    }

    public function edit($id)
    {
        $service = Service::find($id);

        //dd($service);
        return view('barber-services-edit', ['service'=>$service]);
    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        $service->name = $request->name;
        $service->description = $request->description;
        $service->value = $request->value;
        $service->time = $request->time;
        $service->save();

        return redirect()->route('barber.services');
    }
}
