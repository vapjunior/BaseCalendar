@extends('layouts.barber-dash')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Barbeiros</div>

                <div class="panel-body">
                    <!-- You are logged in as <strong>Barber</strong>! -->
                    <!-- <button type="button" class="btn btn-success">Novo</span></button> -->
                    <a class="btn btn-large btn-warning" href="{{ route('barber.barbers.add') }}">Novo</a>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table class="table">
                                <tr>
                                    <th>Nome</th>
                                    <th>Opções</th>
                                </tr>

                                @foreach($barbers as $s)
                                    <tr>
                                        <td>{{$s->name}}</td>
                                        <td>&emsp;<a href="{{ route('barber.barbers.update', ['barber' => $s->id])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            &emsp;<a href="{{ route('barber.barbers.delete', ['barber' => $s->id])}}"><i class="fa fa-times" aria-hidden="true"></i></a></td>
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
