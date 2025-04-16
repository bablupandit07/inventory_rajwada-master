@extends('layouts.app')
@section('title', 'Dashboard')
@push('chart')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Year', 'Sales', 'Expenses', 'Profit'],
                ['2014', 1000, 400, 200],
                ['2015', 1170, 460, 250],
                ['2016', 660, 1120, 300],
                ['2017', 1030, 540, 350]
            ]);

            var options = {
                chart: {
                    title: 'Company Performance',
                    subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                },
                bars: 'vertical',
                vAxis: {
                    format: 'decimal'
                },
                height: 400,
                colors: ['#1b9e77', '#d95f02', '#7570b3']
            };

            var chart = new google.charts.Bar(document.getElementById('chart_div'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Work', 11],
                ['Eat', 2],
                ['Commute', 2],
                ['Watch TV', 2],
                ['Sleep', 7]
            ]);

            var options = {
                title: 'My Daily Activities',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>
@endpush
@section('content')


    <fieldset class="mt-3">
        <legend>Dashboard</legend>
        <div class="row">
            <div class="col-md-3">
                <div class="card mb-3 bg-success bg-gradient shadow-sm">
                    <div class="card-body text-white">
                        <div class="row">
                            <div class="col-8">
                                <small>No. of Party</small>
                                <h5 class="card-title">{{ $total_party }}</h5>
                            </div>
                            <div class="col-4 text-end">
                                <i class="bi bi-person fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3 bg-warning bg-gradient shadow-sm">
                    <div class="card-body text-white">
                        <div class="row">
                            <div class="col-8">
                                <small>No. of Supplier</small>
                                <h5 class="card-title">{{ $total_supplier }}</h5>
                            </div>
                            <div class="col-4 text-end">
                                <i class="bi bi-person fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3 bg-info bg-gradient shadow-sm">
                    <div class="card-body text-white">
                        <div class="row">
                            <div class="col-8">
                                <small>No. of Product</small>
                                <h5 class="card-title">{{ $total_product }}</h5>
                            </div>
                            <div class="col-4 text-end">
                                <i class="bi bi-person fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="card mb-3 bg-danger bg-gradient shadow-sm">
                    <div class="card-body text-white">
                        <div class="row">
                            <div class="col-8">
                                <small>No. of news</small>
                                <h5 class="card-title">5</h5>
                            </div>
                            <div class="col-4 text-end">
                                <i class="bi bi-person fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <!-- <div class="row mb-3">
                                                                                                                    <div class="col-md-8">
                                                                                                                        <div class="card">
                                                                                                                            <div class="card-body">
                                                                                                                                <div id="chart_div"></div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4">
                                                                                                                        <div class="card">
                                                                                                                            <div class="card-body">
                                                                                                                                <div id="donutchart" style="height: 400px;"></div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div> -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-bg-primary bg-gradient">
                        # Table List
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </fieldset>
@endsection
