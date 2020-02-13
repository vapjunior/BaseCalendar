@extends('layouts.user-dash')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Barbeiros</div>

                <div class="panel-body">

                    <div class="row">
                        @foreach($barbers as $p)
                            <div class="col-sm-6 col-md-5">
                              <div class="thumbnail">
                                <!-- <img src="..." alt="..."> -->
                                <div class="caption">
                                  <h3>{{ $p->name }}</h3>
                                  <p>
                                      <a href="{{ route('user.calendar.commit', ['barber' => $p->id])}}" class="btn btn-warning" role="button">Agendar</a>
                                      <!--<a href="{{ route('barber.register.form')}}" class="btn btn-default" role="button">Detalhes</a>-->
                                  </p>
                                </div>
                              </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
