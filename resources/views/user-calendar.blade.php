@extends('layouts.user-dash')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Agenda</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-1">
                            <a class="btn btn-large btn-warning" href="{{ route('user.barber') }}">Agendar</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <table class="table" id="calendar">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Hora</th>
                                        <th>Valor</th>
                                        <th>Barbeiro</th>
                                        <th>Serviço</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
{{--                                <tbody>--}}
{{--                                    @foreach($calendar as $c)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ date_format($c->date,'d/m/Y') }}</td>--}}
{{--                                            <td>{{ $c->time }}</td>--}}
{{--                                            <td>R$ {{ $c->value }}</td>--}}
{{--                                            <td>{{ $c->barber }}</td>--}}
{{--                                            <td>{{ $c->service }}</td>--}}
{{--                                            <td><a href="{{ route('user.calendar.update', ['calendar' => $c->id])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>--}}
{{--                                            <td><a href="{{ route('user.calendar.delete', ['calendar' => $c->id])}}"><i class="fa fa-times" aria-hidden="true"></i></a></td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                </tbody>--}}
                            </table>
                            <script>
                                $(document).ready(function () {
                                    $('#calendar').DataTable({
                                        "processing": true,
                                        "serverSide": true,
                                        "ajax":{
                                            "url": "{{ url('user/calendario') }}",
                                            "dataType": "json",
                                            "type": "POST",
                                            "data":{ _token: "{{csrf_token()}}"}
                                        },
                                        "columns": [
                                            { "data": "date" },
                                            { "data": "time"},
                                            { "data": "value"},
                                            { "data": "barber"},
                                            { "data": "service"},
                                            { "data": "options"}
                                        ],
                                        "oLanguage": {
                                            "sProcessing": "Aguarde enquanto os dados são carregados ...",
                                            "sLengthMenu": "Mostrar _MENU_ registros por pagina",
                                            "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
                                            "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
                                            "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
                                            "sInfoFiltered": "",
                                            "sSearch": "Procurar",
                                            "oPaginate": {
                                                "sFirst":    "Primeiro",
                                                "sPrevious": "Anterior",
                                                "sNext":     "Próximo",
                                                "sLast":     "Último"
                                            }
                                        }

                                    });
                                });
                            </script>
                        </div>
                    </div>

                    <!-- @foreach($calendar as $c)
                        <p>{{ $c->date }}</p>
                    @endforeach -->
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
