@extends('layouts.barber-dash')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Serviços</div>

                <div class="panel-body">
                    <!-- You are logged in as <strong>Barber</strong>! -->
                    <!-- <button type="button" class="btn btn-success">Novo</span></button> -->
                    @if (Auth::user()->role == 0)
                        <a class="btn btn-large btn-warning" href="{{ route('barber.services.add') }}">Novo</a>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Valor</th>
                                    <th>Duração</th>
                                    @if (Auth::user()->role==0)
                                        <th>Opções</th>
                                    @endif
                                </tr>

                                @foreach($services as $s)
                                    <tr>
                                        <td>{{$s->name}}</td>
                                        <td>{{$s->description}}</td>
                                        <td>{{$s->value}}</td>
                                        <td>{{$s->time}} Minutos</td>
                                        @if (Auth::user()->role==0)
                                            <td>&emsp;<a href="{{ route('barber.services.update', ['service' => $s->id])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                &emsp;<a href="{{ route('barber.services.delete', ['service' => $s->id])}}"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                        @endif
                                    </tr>
                                @endforeach

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
