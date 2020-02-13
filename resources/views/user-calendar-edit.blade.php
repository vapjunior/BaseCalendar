@extends('layouts.user-dash')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Agenda</div>

                <div class="panel-body">
                    <p>Agendamento com <strong>{{$calendar->barber}}</strong> </p>

                    <form class="form-horizontal" action="{{ route('user.calendar.update', ['calendar' => $calendar->appointment_id]) }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="service_id" class="col-sm-2 control-label">Qual serviço?</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="service_id" required>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ $calendar->service_id == $service->id ? "selected" : "" }}>{{ucfirst($service->name)}} | R$ {{$service->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date" class="col-sm-2 control-label">Quando?</label>
                            <div class="col-sm-10">
                                <input type="date" id="date" name="date" value="{{ $date }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time" class="col-sm-2 control-label">Horas?</label>
                            <div class="col-sm-10">
                                <input type="time" id="time" name="time" value="{{ $calendar->time }}" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
