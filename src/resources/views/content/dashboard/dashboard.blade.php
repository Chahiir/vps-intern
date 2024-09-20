@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
@endsection

@section('page-script')

<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row">
  {{-- Bar chart --}}
  <div class="col-lg-6 mb-4 order-0">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0 pl-0 pl-sm-2 p-2">Latest Statistics</h5>
      </div>
      <div class="card-body">
        <div id="scoreChart"></div>
      </div>
    </div>
  </div>
  {{-- Line Chart --}}
  <div class="col-lg-6 mb-4 order-0">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0 pl-0 pl-sm-2 p-2">Latest Statistics</h5>
      </div>
      <div class="card-body">
        <div id="visitsChart"></div>
      </div>
    </div>
  </div>
  {{-- Donut Chart--}}
  <div class="col-md-6 col-lg-6 col-xl-6 order-0 mb-4">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0 pl-0 pl-sm-2 p-2">Latest Statistics</h5>
      </div>
      <div class="card-body">
        <div id="donutChart"></div>
      </div>
    </div>
  </div>

  {{-- POLAR Area Chart --}}
  <div class="col-md-6 col-lg-6 col-xl-6 order-0 mb-4">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0 pl-0 pl-sm-2 p-2">Latest Statistics</h5>
      </div>
      <div class="card-body">
        <div id="polarAreaChart"></div>
      </div>
    </div>
  </div>
</div>
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

<script>
  /**
 * Dashboard Analytics
 */

'use strict';
(function () {

  // Bar chart : Average Evaluation Score Chart
  // --------------------------------------------------------------------
  const chartEl = document.querySelector('#scoreChart'),
  chartOptions = {
      series: [{
          name: '',
          data: @json($data) // Replace with your data
      }],
      chart: {
          height: 350,
          stacked: true,
          type: 'bar',
          toolbar: { show: false }
      },
      plotOptions: {
          bar: {
              horizontal: false,
              columnWidth: '10%', // Slimmer bars
              borderRadius: 12,
              startingShape: 'rounded',
              endingShape: 'rounded'
          }
      },
      colors: ['#696cff'], // Customize your color
      dataLabels: {
          enabled: true
      },
      stroke: {
          show: true,
          width: 2
      },
      legend: {
          show: false // Disable legend if not needed
      },
      grid: {
          borderColor: '#e7e7e7',
          padding: {
              top: 0,
              bottom: -8,
              left: 20,
              right: 20
          }
      },
      xaxis: {
          categories:  @json($labels) , // Replace with your department names
          labels: {
              style: {
                  fontSize: '13px',
                  colors: '#6c757d' // Customize axis labels color
              }
          },
          axisTicks: {
              show: false
          },
          axisBorder: {
              show: false
          }
      },
      yaxis: {
          labels: {
              style: {
                  fontSize: '13px',
                  colors: '#6c757d' // Customize axis labels color
              }
          }
      },
      title: {
          text: 'Average Evaluation Score',
          align: 'center'
      },
      responsive: [
          {
              breakpoint: 1700,
              options: {
                  plotOptions: {
                      bar: {
                          columnWidth: '18%' // Adjust for larger screens
                      }
                  }
              }
          },
          {
              breakpoint: 1300,
              options: {
                  plotOptions: {
                      bar: {
                          columnWidth: '22%' // Adjust for medium screens
                      }
                  }
              }
          },
          {
              breakpoint: 768,
              options: {
                  plotOptions: {
                      bar: {
                          columnWidth: '28%' // Adjust for smaller screens
                      }
                  }
              }
          }
      ],
      states: {
          hover: {
              filter: {
                  type: 'none'
              }
          },
          active: {
              filter: {
                  type: 'none'
              }
          }
      }
  };

  if (chartEl) {
      const chart = new ApexCharts(chartEl, chartOptions);
      chart.render();
  }

  // Line chart : Visits Chart
  // --------------------------------------------------------------------
  const visitsChartEl = document.querySelector('#visitsChart'),
    visitsChartOptions = {
        series: [{
            name: 'Visits',
            data: @json($counts) // Replace with your data
        }],
        chart: {
            height: 350,
            type: 'area',
            toolbar: { show: false }
        },
        stroke: {
            curve: 'smooth',
            width: 2,
            colors: ['#ffab00'] // Customize your line color
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.9,
                stops: [0, 90, 100],
                colorStops: [
                    { offset: 0, color: '#ffab00', opacity: 0.4 },
                    { offset: 100, color: '#ffab00', opacity: 0 }
                ]
            }
        },
        xaxis: {
            categories: @json($dates), // Replace with your time categories
            labels: {
                style: {
                    fontSize: '13px',
                    colors: '#6c757d' // Customize axis labels color
                }
            },
            axisTicks: {
                show: false
            },
            axisBorder: {
                show: false
            }
        },
        yaxis: {
            title: {
                text: 'Number of Visits'
            },
            labels: {
                style: {
                    fontSize: '13px',
                    colors: '#6c757d' // Customize axis labels color
                }
            }
        },
        grid: {
            borderColor: '#e7e7e7',
            strokeDashArray: 4,
            padding: {
                top: 0,
                bottom: 0,
                left: 10,
                right: 10
            }
        },
        markers: {
            size: 4,
            colors: ['#ffab00'], // Customize marker color
            strokeColors: '#fff',
            strokeWidth: 2,
            hover: {
                size: 6
            }
        },
        dataLabels: {
            enabled: false
        },
        title: {
            text: 'Visits Statistics Over Time',
            align: 'center'
        },
        responsive: [
            {
                breakpoint: 768,
                options: {
                    markers: {
                        size: 3 // Smaller markers for smaller screens
                    },
                    xaxis: {
                        labels: {
                            style: {
                                fontSize: '11px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                fontSize: '11px'
                            }
                        }
                    }
                }
            }
        ]
    };

  if (visitsChartEl) {
      const visitsChart = new ApexCharts(visitsChartEl, visitsChartOptions);
      visitsChart.render();
  }

  //////////// Donut chart : status of badges/////////////////////
  // --------------------------------------------------------------------
  document.addEventListener('DOMContentLoaded', function () {
    var chartData = document.querySelector('#donutChart');
    var seriesData = [{{ $badgeDispo }}, {{ $badgeIndispo }}];
    var labelsData = ['Badges actifs', 'Badges inactifs'];

    var donutChartConfig = {
        chart: {
            height: 400,
            type: 'donut' // Change this to 'donut'
        },
        labels: labelsData,
        series: seriesData,
        colors: ['#00E396', '#FF4560'], // Add your custom colors here
        stroke: {
            show: false,
            curve: 'straight'
        },
        dataLabels: {
            enabled: true,
            formatter: function (val, opt) {
                return parseInt(val, 10) + '%';
            }
        },
        legend: {
            show: true,
            position: 'bottom',
            markers: { offsetX: -3 },
            itemMargin: {
                vertical: 3,
                horizontal: 10
            },
            labels: {
                useSeriesColors: false
            }
        },
        title: {
            text: 'Status des badges',
            align: 'center'
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '65%', // Adjust the size of the donut hole
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontSize: '1.5rem'
                        },
                        value: {
                            show: true,
                            fontSize: '1rem'
                        },
                        total: {
                            show: true,
                            showAlways: true,
                            label: 'Total',
                            fontSize: '1.5rem'
                        }
                    }
                }
            }
        },
        responsive: [
            {
                breakpoint: 992,
                options: {
                    chart: {
                        height: 380
                    },
                    legend: {
                        position: 'bottom',
                        labels: {
                            useSeriesColors: false
                        }
                    }
                }
            },
            {
                breakpoint: 576,
                options: {
                    chart: {
                        height: 320
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    name: {
                                        fontSize: '1.5rem'
                                    },
                                    value: {
                                        fontSize: '1rem'
                                    },
                                    total: {
                                        fontSize: '1.5rem'
                                    }
                                }
                            }
                        }
                    },
                    legend: {
                        position: 'bottom',
                        labels: {
                            useSeriesColors: false
                        }
                    }
                }
            },
            {
                breakpoint: 420,
                options: {
                    chart: {
                        height: 280
                    },
                    legend: {
                        show: false
                    }
                }
            },
            {
                breakpoint: 360,
                options: {
                    chart: {
                        height: 250
                    },
                    legend: {
                        show: false
                    }
                }
            }
        ]
    };

    var chart = new ApexCharts(document.querySelector("#donutChart"), donutChartConfig);
    chart.render();
  });



  //////////// Polar Area chart : Employees by Department/////////////////////
  document.addEventListener('DOMContentLoaded', function () {
    var polarAreaChartConfig = {
        chart: {
            height: 400,
            type: 'polarArea'
        },
        series: @json($dataSalarie), // Replace with your actual data
        labels: @json($labelsSalarie), // Replace with department names
        fill: {
            opacity: 0.9 // Adjust the fill opacity
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        colors: ['#00E396', '#008FFB', '#FEB019', '#FF4560', '#775DD0'], // Customize colors for each department
        legend: {
            show: true,
            position: 'bottom'
        },
        title: {
            text: 'Employees by Department',
            align: 'center'
        },
        responsive: [
            {
                breakpoint: 576,
                options: {
                    chart: {
                        height: 300
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        ]
    };


    var chart = new ApexCharts(document.querySelector("#polarAreaChart"), polarAreaChartConfig);
    chart.render();
  });

})();
</script>

@endsection
