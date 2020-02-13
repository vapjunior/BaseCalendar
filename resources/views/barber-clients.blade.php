@extends('layouts.barber-dash')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Clientes</div>

                <div class="panel-body">
                    <!-- You are logged in as <strong>Barber</strong>! -->
                    <!-- <button type="button" class="btn btn-success">Novo</span></button> -->
                    <a class="btn btn-large btn-warning" href="{{ route('register') }}">Novo</a>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table class="table" id="clients">
                                <thead>
                                    <th>Nome</th>
                                    <th>Agendar</th>
                                    <th>Opções</th>
                                </thead>

{{--                                @foreach($clients as $s)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{$s->name}}</td>--}}
{{--                                        <td><a href="{{ route('barber.clients.update', ['clients' => $s->id])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>--}}
{{--                                        <td><a href="{{ route('barber.clients.delete', ['clients' => $s->id])}}"><i class="fa fa-times" aria-hidden="true"></i></a></td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}

                            </table>
                        </div>
                        <script>
                            $(document).ready(function () {
                                $('#clients').DataTable({
                                    "processing": true,
                                    "serverSide": true,
                                    "ajax":{
                                        "url": "{{ url('barbeiro/clientes') }}",
                                        "dataType": "json",
                                        "type": "POST",
                                        "data":{ _token: "{{csrf_token()}}"}
                                    },
                                    "columns": [
                                        { "data": "name" },
                                        { "data": "calendar"},
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
            </div>
        </div>
    </div>
</div>
@endsection

