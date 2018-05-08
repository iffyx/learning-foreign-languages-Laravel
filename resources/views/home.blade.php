@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Moje konto</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Jesteś zalogowany jako
                        @if(Auth::user()->hasRole('admin'))
                            Admin
                        @elseif(Auth::user()->hasRole('user'))
                            User
                        @elseif(Auth::user()->hasRole('redaktor'))
                            Redaktor
                        @elseif(Auth::user()->hasRole('superredaktor'))
                            Super Redaktor
                        @endif
                    </p>

                        @if(Auth::user()->hasRole('admin'))
                            Zarządzaj:
                            <a href="{{ url('/categories') }}">kategoriami</a>
                            <a href="{{ url('/subcategories') }}">podkategoriami</a>
                            <a href="{{ url('/sets') }}">zestawami</a>
                            <a href="{{ url('/users') }}">użytkownikami</a>
                            @elseif(Auth::user()->hasRole('redaktor'))
                            Zarządzaj:
                            <a href="{{ url('/sets') }}">zestawami</a>
                            @elseif(Auth::user()->hasRole('superredaktor'))
                            Zarządzaj:
                            <a href="{{ url('/sets') }}">zestawami</a>
                        @endif
                </div>
                {{--<canvas id="bar-chart" width="800" height="450"></canvas>--}}
                <div id="chartContainer" style="height: 400px; width: 100%;"></div>

                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "light1", // "light2", "dark1", "dark2"
            animationEnabled: true, // change to true
            title:{
                text: "Wyniki testów"
            },
            axisY:{
                minimum: 0,
                maximum: 100,
                suffix: "%"
            },
            legend:{
                cursor: "pointer",
                fontSize: 16,
                itemclick: toggleDataSeries
            },
            data: [

                    @foreach($sets as $set)

                {
                    // Change type to column "bar", "area", "spline", "pie",etc.
                    name: "{{$set->name}}",
                    type: "spline",
                    showInLegend: true,
                    dataPoints: [
                            @foreach($result as $res)
                            @if($set->id==$res->set_id)
                        { label: "{{$res->created_at}}",  y: {{$res->result}}  },
                        @endif
                            @endforeach

                    ]
                },

                    @endforeach

            ]
        });
        chart.render();

        function toggleDataSeries(e){
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            }
            else{
                e.dataSeries.visible = true;
            }
            chart.render();
        }

    }



</script>
@endsection
