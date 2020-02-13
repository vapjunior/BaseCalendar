@extends('layouts.barber-dash')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Cliente</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('barber.clients.update', ['client' => $client->id]) }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-sm-2 control-label">Nome</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $client->name }}" placeholder="Nome" required autofocus>

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
                                <input id="email" type="email" class="form-control" name="email" value="{{ $client->email }}" placeholder="E-Mail" required>

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
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ $client->phone }}" placeholder="Celular" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                            <label for="sex" class="col-md-2 control-label">Sexo</label>

                            <div class="col-md-6">
                                <div class="radio">
                                    <label><input type="radio" id="sex" name="sex" value="M" {{$client->sex == "M" ? "checked":"" }} >Masculino</label>
                                </div>

                                <div class="radio">
                                    <label><input type="radio" id="sex" name="sex" value="F" {{$client->sex == "F" ? "checked":"" }}>Feminino</label>
                                </div>

                                @if ($errors->has('sex'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sex') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('birthDate') ? ' has-error' : '' }}">
                            <label for="birthDate" class="col-md-2 control-label">Data Nascimento</label>

                            <div class="col-md-6">
                                <input type="date" id="birthDate" name="birthDate" value="{{ $client->birthDate }}">

                                @if ($errors->has('birthDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthDate') }}</strong>
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
