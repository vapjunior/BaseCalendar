@extends('layouts.barber-dash')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Agenda</div>

                <div class="panel-body">

                    <a class="btn btn-large btn-warning" href="{{ route('barber.clients') }}">Agendar</a>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped" id="calendar">
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
{{--                                <tbody>--}}
{{--                                    @foreach($calendar as $c)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ date_format($c->date,'d/m/Y') }}</td>--}}
{{--                                            <td>{{ $c->time }}</td>--}}
{{--                                            <td>{{ $c->barber}} </td>--}}
{{--                                            <td>{{ $c->client }}</td>--}}
{{--                                            <td>{{ $c->service }}</td>--}}
{{--                                            <td>R$ {{ $c->value }}</td>--}}
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
                                            "url": "{{ url('barbeiro/calendario') }}",
                                            "dataType": "json",
                                            "type": "POST",
                                            "data":{ _token: "{{csrf_token()}}"}
                                        },
                                        "columns": [
                                            { "data": "date" },
                                            { "data": "time"},
                                            { "data": "barber"},
                                            { "data": "client"},
                                            { "data": "service"},
                                            { "data": "value"}
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
