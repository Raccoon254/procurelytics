@extends('layouts.app')

@section('title', 'Procurement Data Visualization')

@section('content')
    <div class="flex flex-col md:flex-row">
        <div class="w-full md:w-1/2 p-3">
            <div class="chart-container h-64 md:h-auto">
                <canvas id="procurementChart"></canvas>
            </div>
        </div>
        <div class="w-full md:w-1/2 p-3">
            <div class="chart-container h-64 md:h-auto">
                <canvas id="procurementChartFirmCategory"></canvas>
            </div>
        </div>
    </div>
    <div class="flex flex-col md:flex-row">
        <div class="w-full md:w-1/2 p-3">
            <div class="chart-container h-64 md:h-auto">
                <canvas id="procurementChartSpendCategory"></canvas>
            </div>
        </div>
        <div class="w-full md:w-1/2 p-3">
            <div class="chart-container h-64 md:h-auto">
                <canvas id="procurementPieChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('procurementChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [@foreach($procurements as $proc) "{{ $proc->created_at->format('Y-m-d') }}", @endforeach],
                datasets: [{
                    label: 'Amount',
                    data: [@foreach($procurements as $proc) {{ $proc->amount }}, @endforeach],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false,
                    tension: 0.3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxFirmCategory = document.getElementById('procurementChartFirmCategory').getContext('2d');
        var labelsFirmCategory = [@foreach($procurements as $proc) "{{ $proc->firm_name }} - {{ $proc->category->name }}", @endforeach];
        var dataFirmCategory = [@foreach($procurements as $proc) {{ $proc->amount }}, @endforeach];
        var myChartFirmCategory = new Chart(ctxFirmCategory, {
            type: 'line',
            data: {
                labels: labelsFirmCategory,
                datasets: [{
                    label: 'Amount',
                    data: dataFirmCategory,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false,
                    tension: 0.3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxSpendCategory = document.getElementById('procurementChartSpendCategory').getContext('2d');
        var labelsSpendCategory = [@foreach($procurements as $proc) "{{ $proc->firm_name }} - {{ $proc->spendCategory->name }}", @endforeach];
        var dataSpendCategory = [@foreach($procurements as $proc) {{ $proc->amount }}, @endforeach];
        var myChartSpendCategory = new Chart(ctxSpendCategory, {
            type: 'line',
            data: {
                labels: labelsSpendCategory,
                datasets: [{
                    label: 'Amount',
                    data: dataSpendCategory,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false,
                    tension: 0.3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxPie = document.getElementById('procurementPieChart').getContext('2d');
        var labelsPie = [@foreach($procurements as $proc) "{{ $proc->firm_name }}", @endforeach];
        var dataPie = [@foreach($procurements as $proc) {{ $proc->amount }}, @endforeach];
        var myPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: labelsPie,
                datasets: [{
                    data: dataPie,
                    backgroundColor: ['#ff6384', '#36a2eb', '#cc65fe', '#ffce56', '#9CCC65', '#26C6DA'],
                }]
            },
        });
    </script>
@endsection
