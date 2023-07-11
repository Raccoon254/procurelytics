@extends('layouts.app')

@section('title', 'Procurement Data Visualization')

@section('content')
    <div class="flex flex-col md:flex-row">
        <div class="w-full md:w-1/2 p-3">
            <div class="chart-container h-64 md:h-auto" id="procurementChart"></div>
        </div>
        <div class="w-full md:w-1/2 p-3">
            <div class="chart-container h-64 md:h-auto" id="procurementChartFirmCategory"></div>
        </div>
    </div>
    <div class="flex flex-col md:flex-row">
        <div class="w-full md:w-1/2 p-3">
            <div class="chart-container h-64 md:h-auto" id="procurementChartSpendCategory"></div>
        </div>
        <div class="w-full md:w-1/2 p-3">
            <div class="chart-container h-64 md:h-auto" id="procurementPieChart"></div>
        </div>
    </div>

    <script>
        var procurementChart = new ApexCharts(document.querySelector("#procurementChart"), {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'Amount',
                data: [@foreach($procurements as $proc) {{ $proc->amount }}, @endforeach]
            }],
            xaxis: {
                categories: [@foreach($procurements as $proc) "{{ $proc->created_at->format('Y-m-d') }}", @endforeach]
            }
        });
        procurementChart.render();

        var procurementChartFirmCategory = new ApexCharts(document.querySelector("#procurementChartFirmCategory"), {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'Amount',
                data: [@foreach($procurements as $proc) {{ $proc->amount }}, @endforeach]
            }],
            xaxis: {
                categories: [@foreach($procurements as $proc) "{{ $proc->firm_name }} - {{ $proc->category->name }}", @endforeach]
            }
        });
        procurementChartFirmCategory.render();

        var procurementChartSpendCategory = new ApexCharts(document.querySelector("#procurementChartSpendCategory"), {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'Amount',
                data: [@foreach($procurements as $proc) {{ $proc->amount }}, @endforeach]
            }],
            xaxis: {
                categories: [@foreach($procurements as $proc) "{{ $proc->firm_name }} - {{ $proc->spendCategory->name }}", @endforeach]
            }
        });
        procurementChartSpendCategory.render();

        var procurementPieChart = new ApexCharts(document.querySelector("#procurementPieChart"), {
            chart: {
                type: 'pie'
            },
            labels: [@foreach($procurements as $proc) "{{ $proc->firm_name }}", @endforeach],
            series: [@foreach($procurements as $proc) {{ $proc->amount }}, @endforeach]
        });
        procurementPieChart.render();
    </script>
@endsection
