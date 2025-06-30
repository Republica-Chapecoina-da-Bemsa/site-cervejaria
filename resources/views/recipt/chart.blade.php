@extends('baseadm')
@section('titulo', 'Itens Vendidos - Gráfico')

@section('conteudo')

<body>


    <div class="p-6 m-20 bg-white rounded">
        {!! $chart->container() !!}
    </div>


    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}
</body>

</html>
@endsection