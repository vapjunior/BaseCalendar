@extends('layouts.barber-dash')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Relatório Total de {{$date}}</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Hora</th>
                                        <th>Barbeiro</th>
                                        <th>Cliente</th>
                                        <th>Serviço</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $c)
                                        <tr>
                                            <td>{{ date_format($c->date,'d/m/Y') }}</td>
                                            <td>{{ $c->time }}</td>
                                            <td>{{ $c->barber_name}}</td>
                                            <td>{{ $c->client_name }}</td>
                                            <td>{{ $c->service_name }}</td>
                                            <td>R$ {{ $c->value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            <div class="row">
                                <div class="col-md-3 col-md-offset-9">
                                    <div class="well">  
                                        Total: R$ {{ $total }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @foreach ($apbarber as $ap)
                <div class="panel panel-default">
                    <div class="panel-heading">Relatório Total - {{ $ap[0]->barber_name}} - {{$date}}</div>
                    
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Hora</th>
                                            <th>Cliente</th>
                                            <th>Serviço</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ap as $a)
                                            <tr>
                                                <td>{{ date_format($c->date,'d/m/Y') }}</td>
                                                <td>{{ $c->time }}</td>
                                                <td>{{ $c->client_name }}</td>
                                                <td>{{ $c->service_name }}</td>
                                                <td>R$ {{ $c->value }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
