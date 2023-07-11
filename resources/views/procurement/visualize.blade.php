@extends('layouts.app')

@section('title', 'Procurement Data Visualization')

@section('content')
    <div class="flex flex-col md:flex-row">
        <div class="w-full md:w-1/2 p-3">
            <center>Total Procurements Over Time</center>
            <div class="chart-container h-64 md:h-auto" id="procurementCountChart"></div>
        </div>
        <div class="w-full md:w-1/2 p-3">
            <center>Average Procurement Amount per Firm</center>
            <div class="chart-container h-64 md:h-auto" id="procurementAvgChartFirm"></div>
        </div>
    </div>
    <div class="flex flex-col md:flex-row">
        <div class="w-full md:w-1/2 p-3">
            <center>Cash Spent Against Date</center>
            <div class="chart-container h-64 md:h-auto" id="procurementChart"></div>
        </div>
        <div class="w-full md:w-1/2 p-3">
            <center>Cash Spent Against Firms</center>
            <div class="chart-container h-64 md:h-auto" id="procurementChartFirmCategory"></div>
        </div>
    </div>
    <div class="flex flex-col md:flex-row">
        <div class="w-full md:w-1/2 p-3">
            <center>Cash Spent Against Category</center>
            <div class="chart-container h-64 md:h-auto" id="procurementChartSpendCategory"></div>
        </div>
        <div class="w-full md:w-1/2 p-3">
            <center>Firms Pie Chart</center>
            <div class="chart-container h-64 md:h-auto" id="procurementPieChart"></div>
        </div>

    </div>

        <!--.....-->
    <div class="flex flex-col md:flex-row">
        <div class="w-full md:w-1/2 p-3">
            <center>Procurements by Category</center>
            <div class="chart-container h-64 md:h-auto" id="procurementByCategoryChart"></div>
        </div>
        <div class="w-full md:w-1/2 p-3">
            <center>Procurements by Spend Category</center>
            <div class="chart-container h-64 md:h-auto" id="procurementBySpendCategoryChart"></div>
        </div>
    </div>
    <div class="flex flex-col md:flex-row">
        <div class="w-full md:w-1/2 p-3">
            <center>Procurements by Procurement Method</center>
            <div class="chart-container h-64 md:h-auto" id="procurementByMethodChart"></div>
        </div>
    </div>



    <script>

        @php
            $dates = $procurements->groupBy(function($item) {
                return $item->created_at->format('Y-m-d');
            });

            $amountsByDate = $dates->map(function($items, $date) {
                return $items->sum('amount');
            });

            $dates = $procurements->groupBy(function($item) {
                return $item->created_at->format('Y-m-d');
            });

            $countByDate = $dates->map(function($items, $date) {
                return $items->count();
            });

            $firms = $procurements->groupBy('firm_name');

            $avgAmountByFirm = $firms->map(function($items, $firm) {
                return $items->avg('amount');
            });

            $categories = $procurements->groupBy('category_id');
            $countByCategory = $categories->map(function($items, $category) {
                return $items->count();
            });

            $spendCategories = $procurements->groupBy('spend_category_id');
            $countBySpendCategory = $spendCategories->map(function($items, $spendCategory) {
                return $items->count();
            });

            $methods = $procurements->groupBy('procurement_method');
            $countByMethod = $methods->map(function($items, $method) {
                return $items->count();
            });


        @endphp

        var procurementChart = new ApexCharts(document.querySelector("#procurementChart"), {
            chart: {
                type: 'area'
            },
            fill: {
                colors: ['#2E93fA', '#66DA26'],
                opacity: 0.9,
                type: 'gradient',
                fillTo: -20,
            },
            stroke: {
                show: true,
                lineCap: 'butt',
                colors: ['#2E93fA', '#66DA26', '#546E7A', '#E91E63', '#FF9800'],
                width: 2,
                dashArray: 0,
            },
            markers: {
                size: 2,
            },
            series: [{
                name: 'Total Amount',
                data: [@foreach($amountsByDate as $amount) {{ $amount }}, @endforeach]
            }],
            xaxis: {
                categories: [@foreach($amountsByDate as $date => $amount) "{{ $date }}", @endforeach]
            },
            plotOptions: {
                area: {
                    fillTo: 'end'
                }
            }
        });
        procurementChart.render();

        var procurementChartFirmCategory = new ApexCharts(document.querySelector("#procurementChartFirmCategory"), {
            chart: {
                type: 'area'
            },
            stroke: {
                show: true,
                lineCap: 'butt',
                colors: ['#2E93fA', '#66DA26', '#546E7A', '#E91E63', '#FF9800'],
                width: 2,
                dashArray: 0,
            },
            markers: {
                size: 2,
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
                type: 'area'
            },
            stroke: {
                show: true,
                lineCap: 'butt',
                colors: ['#2E93fA', '#66DA26', '#546E7A', '#E91E63', '#FF9800'],
                width: 2,
                dashArray: 0,
            },
            markers: {
                size: 2,
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

        // Then, use the prepared data in JavaScript
        var procurementCountChart = new ApexCharts(document.querySelector("#procurementCountChart"), {
            chart: {
                type: 'area'
            },
            // other chart options...
            series: [{
                name: 'Procurements Count',
                data: [@foreach($countByDate as $count) {{ $count }}, @endforeach]
            }],
            xaxis: {
                categories: [@foreach($countByDate as $date => $count) "{{ $date }}", @endforeach]
            }
            // other chart options...
        });
        procurementCountChart.render();

        var procurementAvgChartFirm = new ApexCharts(document.querySelector("#procurementAvgChartFirm"), {
            chart: {
                type: 'bar'
            },
            // other chart options...
            series: [{
                name: 'Average Amount',
                data: [@foreach($avgAmountByFirm as $avg) {{ $avg }}, @endforeach]
            }],
            xaxis: {
                categories: [@foreach($avgAmountByFirm as $firm => $avg) "{{ $firm }}", @endforeach]
            }
            // other chart options...
        });
        procurementAvgChartFirm.render();

        var procurementByCategoryChart = new ApexCharts(document.querySelector("#procurementByCategoryChart"), {
            chart: { type: 'bar' },
            series: [{
                name: 'Procurements Count',
                data: [@foreach($countByCategory as $count) {{ $count }}, @endforeach]
            }],
            xaxis: {
                categories: [@foreach($countByCategory as $category => $count) "{{ App\Models\Category::find($category)->name }}", @endforeach]
            }
        });
        procurementByCategoryChart.render();

        var procurementBySpendCategoryChart = new ApexCharts(document.querySelector("#procurementBySpendCategoryChart"), {
            chart: { type: 'bar' },
            series: [{
                name: 'Procurements Count',
                data: [@foreach($countBySpendCategory as $count) {{ $count }}, @endforeach]
            }],
            xaxis: {
                categories: [@foreach($countBySpendCategory as $spendCategory => $count) "{{ App\Models\SpendCategory::find($spendCategory)->name }}", @endforeach]
            }
        });
        procurementBySpendCategoryChart.render();

        var procurementByMethodChart = new ApexCharts(document.querySelector("#procurementByMethodChart"), {
            chart: { type: 'bar' },
            series: [{
                name: 'Procurements Count',
                data: [@foreach($countByMethod as $count) {{ $count }}, @endforeach]
            }],
            xaxis: {
                categories: [@foreach($countByMethod as $method => $count) "{{ $method }}", @endforeach]
            }
        });
        procurementByMethodChart.render();
    </script>
@endsection
