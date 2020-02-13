@extends('layouts.barber-dash')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Serviços - Editar Serviço</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('barber.services.update', ['service' => $service->id]) }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nome:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nome" value="{{ $service->name }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Descrição:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Descrição">{{ $service->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="time" class="col-sm-2 control-label">Duração:</label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="time" name="time" placeholder="Duração" value="{{ $service->time }}" required autofocus>
                                    <div class="input-group-addon">Minutos</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="value" class="col-sm-2 control-label">Valor:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-addon">R$</div>
                                    <input type="number" step="any" class="form-control text-right" id="value" name="value" value="{{ $service->value }}" placeholder="00">
                                    <div class="input-group-addon">.00</div>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" name="barber_id" value="{{ Auth::user()->id }}">
                        <button type="submit" class="btn btn-warning">Salvar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
