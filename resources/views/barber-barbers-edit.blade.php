@extends('layouts.barber-dash')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Barbeiro</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('barber.barbers.update', ['barber' => $barber->id]) }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-sm-2 control-label">Nome</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $barber->name }}" placeholder="Nome" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-sm-2 control-label">E-Mail</label>

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $barber->email }}" placeholder="E-Mail" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-2 control-label">Celular</label>

                            <div class="col-md-10">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ $barber->phone }}" placeholder="Celular" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-2 control-label">Nível</label>

                            <div class="col-md-4">
                                <select name="role" class="form-control">
                                    <option value ="1" {{$barber->role == 1 ? "selected":"" }} >Barbeiro</option>
                                    <option value ="0" {{$barber->role == 0 ? "selected":"" }} >Administrador</option>
                                </select>

                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
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
