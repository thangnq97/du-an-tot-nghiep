@extends('layouts.admin.layout')

@section('content')
    <div class="my-4 row">
        <div class="col-5">
            <div class="py-3 m-20 bg-white rounded shadow">
                {!! $chart->container() !!}
            </div>
        </div>
        <div class="col-7">
            <div class="p-6 bg-white rounded shadow">
                <h1>{{ $chart1->options['chart_title'] }}</h1>
                                {!! $chart1->renderHtml() !!}
            </div>
        </div>
    </div>
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}
@endsection