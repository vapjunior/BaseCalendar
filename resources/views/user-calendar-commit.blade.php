@extends('layouts.user-dash')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Agenda</div>

                <div class="panel-body">

                    <form class="form-horizontal" method="post">

                        <div class="form-group">
                            <label for="client_id" class="col-sm-2 control-label">Cliente</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="barber_id" id="barber_id" required readonly aria-disabled>
                                    <option value="{{ $barber->id }}">{{ucfirst($barber->name)}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="service_id" class="col-sm-2 control-label">Qual serviço?</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="service_id" name="service_id" required>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ucfirst($service->name)}} | R$ {{$service->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date" class="col-sm-2 control-label">Quando?</label>
                            <div class="col-sm-10">
                                <input type="date" id="date" name="date" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time" class="col-sm-2 control-label">Horas?</label>
                            <div class="col-sm-10">
                                <input type="time" id="time" name="time" required>
                            </div>
                        </div>

                        <!-- <button type="submit" id="btn-submit" class="btn btn-warning">Salvar</button> -->
                    </form>
                </div>
                <div class="panel-footer">
                    <center><button type="submit" id="btn-submit" class="btn btn-primary">Salvar</button></center>
                </div>
            </div>
            <script type="text/javascript">

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $("#btn-submit").click(function(e){
                    e.preventDefault();

                    var barber = $("#barber_id").val();
                    var service = $("#service_id").val();
                    var date = $("#date").val();
                    var time = $("#time").val();

                    if(date == "" || time == ""){
                        Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: 'Preencha os campos obrigatórios.',
                        })
                    }else{
                        $.ajax({
                            type:'POST',
                            url:'/user/barbeiros/agendar',
                            dataType: 'json',
                            data:{barber_id:barber, service_id:service, date:date, time:time},
                            success:function(data){
                                window.location.href = "/user/calendario";
                            },
                            error:function(data){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Esse horário já está reservado!',
                                })
                            }
                        });
                    }
                });
            </script>
        </div>
    </div>
</div>
@endsection
