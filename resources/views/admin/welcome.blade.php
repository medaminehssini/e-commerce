
@extends('admin.index')
@push('css')
<link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/vendors/css/charts/apexcharts.css">

<link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/css/pages/dashboard-ecommerce.css">
<link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/css/pages/card-analytics.css">
@endpush
@section('content')

<div class="content-header row">
</div>
<div class="content-header row">
</div>
<div class="content-body">
    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column align-items-start pb-0">
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-users text-primary font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700 mt-1">{{$summSubs > 1000 ? $summSubs/1000 .'K' :  $summSubs}}</h2>
                        <p class="mb-0">Subscribers Gained</p>
                    </div>
                    <div class="card-content">
                        <div id="line-area-chart-1"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column align-items-start pb-0">
                        <div class="avatar bg-rgba-success p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-shopping-cart text-danger font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700 mt-1">{{$summrevenues > 1000 ? $summrevenues/1000 .'K' :  $summrevenues}}</h2>
                        <p class="mb-0">Revenue Generated</p>
                    </div>
                    <div class="card-content">
                        <div id="line-area-chart-2"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column align-items-start pb-0">
                        <div class="avatar bg-rgba-warning p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-package text-warning font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700 mt-1"> {{$summorders > 1000 ? $summorders/1000 .'K' :  $summorders}} </h2>
                        <p class="mb-0">Orders Received</p>
                    </div>
                    <div class="card-content">
                        <div id="line-area-chart-4"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-end">
                        <h4 class="card-title">Revenue</h4>
                        <p class="font-medium-5 mb-0"><i class="feather icon-settings text-muted cursor-pointer"></i></p>
                    </div>
                    <div class="card-content">
                        <div class="card-body pb-0">
                            <div class="d-flex justify-content-start">
                                <div class="mr-2">
                                    <p class="mb-50 text-bold-600">This Years</p>
                                    <h2 class="text-bold-400">
                                        <sup class="font-medium-1">{{getSetting('currency')}}</sup>
                                        @php
                                            $somme = 0 ;
                                            foreach ($thisYears as $key => $value) {
                                                $somme += $value;
                                            }
                                        @endphp
                                        <span class="text-success">{{$somme > 1000 ? $somme/1000 .'K' :  $somme}}</span>
                                    </h2>
                                </div>
                                <div>
                                    @php
                                        $somme = 0 ;
                                        foreach ($lastYears as $key => $value) {
                                            $somme += $value;
                                        }
                                    @endphp
                                    <p class="mb-50 text-bold-600">Last Year</p>
                                    <h2 class="text-bold-400">
                                        <sup class="font-medium-1">{{getSetting('currency')}}</sup>
                                        <span>{{$somme > 1000 ? $somme/1000 .'K' :  $somme}}</span>
                                    </h2>
                                </div>

                            </div>
                            <div id="revenue-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-md-8 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Client Retention</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div id="client-retention-chart">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h4 class="card-title">Clients</h4>
                        <div class="dropdown chart-dropdown">
                            <button class="btn btn-sm border-0 dropdown-toggle px-0" type="button" id="dropdownItem3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Last 7 Days
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem3">
                                <a class="dropdown-item" href="#">Last 28 Days</a>
                                <a class="dropdown-item" href="#">Last Month</a>
                                <a class="dropdown-item" href="#">Last Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body py-0">
                            <div id="customer-chart"></div>
                        </div>
                        <ul class="list-group list-group-flush customer-info">
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-primary"></i>
                                    <span class="text-bold-600">Nouveaux</span>
                                </div>
                                <div class="product-result">
                                    <span>{{$clients[0]}}</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-warning"></i>
                                    <span class="text-bold-600">Anciens</span>
                                </div>
                                <div class="product-result">
                                    <span>{{$clients[1]}}</span>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Dashboard Ecommerce ends -->

</div>
@endsection


@push('scripts')
        <!-- BEGIN: Page Vendor JS-->
        <script src="{{url('')}}/app-assets/vendors/js/charts/apexcharts.min.js"></script>
        <!-- END: Page Vendor JS-->

<script>
$(window).on("load", function () {
var $primary = '#7367F0';
var $success = '#28C76F';
var $danger = '#EA5455';
var $warning = '#FF9F43';
var $info = '#00cfe8';
var $primary_light = '#A9A2F6';
var $danger_light = '#f29292';
var $success_light = '#55DD92';
var $warning_light = '#ffc085';
var $info_light = '#1fcadb';
var $strok_color = '#b9c3cd';
var $label_color = '#e7e7e7';
var $white = '#fff';
              // Line Area Chart - 1
  // ----------------------------------

  var gainedlineChartoptions = {
    chart: {
      height: 100,
      type: 'area',
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true
      },
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
    },
    colors: [$primary],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2.5
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 0.9,
        opacityFrom: 0.7,
        opacityTo: 0.5,
        stops: [0, 80, 100]
      }
    },
    series: [{
      name: 'Subscribers',
      data: [{{$subscribers[0]}}, {{$subscribers[1]}}, {{$subscribers[2]}}, {{$subscribers[3]}}, {{$subscribers[4]}}, {{$subscribers[5]}}, {{$subscribers[6]}}]
    }],

    xaxis: {
      labels: {
        show: false,
      },
      axisBorder: {
        show: false,
      }
    },
    yaxis: [{
      y: 0,
      offsetX: 0,
      offsetY: 0,
      padding: { left: 0, right: 0 },
    }],
    tooltip: {
      x: { show: false }
    },
  }

  var gainedlineChart = new ApexCharts(
    document.querySelector("#line-area-chart-1"),
    gainedlineChartoptions
  );

  gainedlineChart.render();

  var revenuelineChartoptions = {
    chart: {
      height: 100,
      type: 'area',
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true
      },
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
    },
    colors: [$success],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2.5
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 0.9,
        opacityFrom: 0.7,
        opacityTo: 0.5,
        stops: [0, 80, 100]
      }
    },
    series: [{
      name: 'Revenue',
      data: [{{$revenues[0]}}, {{$revenues[1]}}, {{$revenues[2]}}, {{$revenues[3]}}, {{$revenues[4]}}, {{$revenues[5]}}, {{$revenues[6]}}]
    }],

    xaxis: {
      labels: {
        show: false,
      },
      axisBorder: {
        show: false,
      }
    },
    yaxis: [{
      y: 0,
      offsetX: 0,
      offsetY: 0,
      padding: { left: 0, right: 0 },
    }],
    tooltip: {
      x: { show: false }
    },
  }

  var revenuelineChart = new ApexCharts(
    document.querySelector("#line-area-chart-2"),
    revenuelineChartoptions
  );

  revenuelineChart.render();

  var orderlineChartoptions = {
    chart: {
      height: 100,
      type: 'area',
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true
      },
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
    },
    colors: [$warning],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2.5
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 0.9,
        opacityFrom: 0.7,
        opacityTo: 0.5,
        stops: [0, 80, 100]
      }
    },
    series: [{
      name: 'Orders',
      data: [{{$orders[0]}}, {{$orders[1]}}, {{$orders[2]}}, {{$orders[3]}}, {{$orders[4]}}, {{$orders[5]}}, {{$orders[6]}}]
    }],

    xaxis: {
      labels: {
        show: false,
      },
      axisBorder: {
        show: false,
      }
    },
    yaxis: [{
      y: 0,
      offsetX: 0,
      offsetY: 0,
      padding: { left: 0, right: 0 },
    }],
    tooltip: {
      x: { show: false }
    },
  }

  var orderlineChart = new ApexCharts(
    document.querySelector("#line-area-chart-4"),
    orderlineChartoptions
  );

  orderlineChart.render();


  // revenue-chart Chart
  // -----------------------------

  var revenueChartoptions = {
    chart: {
      height: 270,
      toolbar: { show: false },
      type: 'line',
    },
    stroke: {
      curve: 'smooth',
      dashArray: [0, 8],
      width: [4, 2],
    },
    grid: {
      borderColor: $label_color,
    },
    legend: {
      show: false,
    },
    colors: [$danger_light, $strok_color],

    fill: {
      type: 'gradient',
      gradient: {
        shade: 'dark',
        inverseColors: false,
        gradientToColors: [$primary, $strok_color],
        shadeIntensity: 1,
        type: 'horizontal',
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 100, 100, 100]
      },
    },
    markers: {
      size: 0,
      hover: {
        size: 5
      }
    },
    xaxis: {
      labels: {
        style: {
          colors: $strok_color,
        }
      },
      axisTicks: {
        show: false,
      },
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      axisBorder: {
        show: false,
      },
      tickPlacement: 'on',
    },
    yaxis: {
      tickAmount: 5,
      labels: {
        style: {
          color: $strok_color,
        },
        formatter: function (val) {
          return val > 999 ? (val / 1000).toFixed(1) + 'k' : val;
        }
      }
    },
    tooltip: {
      x: { show: false }
    },
    series: [{
      name: "This Year",
      data: {{ json_encode($thisYears) }}
    },
    {
      name: "Last Year",
      data: {{ json_encode($lastYears) }}
    }
    ],

  }

  var revenueChart = new ApexCharts(
    document.querySelector("#revenue-chart"),
    revenueChartoptions
  );

  revenueChart.render();

  //customers chart

   var customerChartoptions = {
    chart: {
      type: 'pie',
      height: 330,
      dropShadow: {
        enabled: false,
        blur: 5,
        left: 1,
        top: 1,
        opacity: 0.2
      },
      toolbar: {
        show: false
      }
    },
    labels: ['New', 'Returning'],
    series: [{{$clients[0]}}, {{$clients[1]}}],
    dataLabels: {
      enabled: false
    },
    legend: { show: false },
    stroke: {
      width: 5
    },
    colors: [$primary, $warning],
    fill: {
      type: 'gradient',
      gradient: {
        gradientToColors: [$primary_light, $warning_light]
      }
    }
  }

  var customerChart = new ApexCharts(
    document.querySelector("#customer-chart"),
    customerChartoptions
  );

  customerChart.render();

  // clients by months

  var clientChartoptions = {
    chart: {
      stacked: true,
      type: 'bar',
      toolbar: { show: false },
      height: 300,
    },
    plotOptions: {
      bar: {
        columnWidth: '10%'
      }
    },
    colors: [$primary, $danger],
    series: [{
      name: 'New Clients',
      data: [{{$clientsByMonth[0]}}, {{$clientsByMonth[1]}},{{$clientsByMonth[2]}}, {{$clientsByMonth[3]}},{{$clientsByMonth[4]}}, {{$clientsByMonth[5]}},{{$clientsByMonth[6]}}, {{$clientsByMonth[7]}},{{$clientsByMonth[8]}}, {{$clientsByMonth[9]}},{{$clientsByMonth[10]}}, {{$clientsByMonth[11]}}]
    }],
    grid: {
      borderColor: $label_color,
      padding: {
        left: 0,
        right: 0
      }
    },
    legend: {
      show: true,
      position: 'top',
      horizontalAlign: 'left',
      offsetX: 0,
      fontSize: '14px',
      markers: {
        radius: 50,
        width: 10,
        height: 10,
      }
    },
    dataLabels: {
      enabled: false
    },
    xaxis: {
      labels: {
        style: {
          colors: $strok_color,
        }
      },
      axisTicks: {
        show: false,
      },
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      tickAmount: 5,
      labels: {
        style: {
          color: $strok_color,
        }
      }
    },
    tooltip: {
      x: { show: false }
    },
  }

  var clientChart = new ApexCharts(
    document.querySelector("#client-retention-chart"),
    clientChartoptions
  );

  clientChart.render();

});


</script>




    <!-- BEGIN: Page JS-->
    <script src="{{url('')}}/app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>
    <!-- END: Page JS-->

@endpush
