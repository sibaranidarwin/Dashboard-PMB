@extends('vendor.layouts.sidebar')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/argon-dashboard.css')}}">
<style>
    #jumlah {
    height: 400px;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#datatable {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

#datatable caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

#datatable th {
    font-weight: 600;
    padding: 0.5em;
}

#datatable td,
#datatable th,
#datatable caption {
    padding: 0.5em;
}

#datatable thead tr,
#datatable tr:nth-child(even) {
    background: #f8f8f8;
}

#datatable tr:hover {
    background: #f1f7ff;
}
.posisi{
    float: right;
}

</style>

<h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dashboard Penerimaan Mahasiswa Baru</strong></h4>
<hr>
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->

        <div class="row mt-2">
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            {{-- <div class="stat-icon dib flat-color-2">
                                <i class="fa fa-file"></i>
                            </div> --}}
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-heading"><strong> Peminat 2022</strong></div>
                                    <div class="stat-text"><strong class="count">{{ $good_receipt}}</strong></div>
                                    {{-- <div class="stat-heading">Good Receipt</div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            {{-- <div class="stat-icon dib flat-color-1">
                                <i class="fa fa-newspaper-o"></i>
                            </div> --}}
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-heading"><strong>Lulus 2022</strong></div>
                                    <div class="stat-text"><strong class="count">{{ $draft}}</strong></div>
                                    {{-- <div class="stat-heading">Good Receipt</div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            {{-- <div class="stat-icon dib flat-color-5">
                                <i class="fa fa-newspaper-o"></i>
                            </div> --}}
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-heading"><strong>Tidak Lulus 2022</strong></div>
                                    <div class="stat-text"><strong class="count">{{ $ba}}</strong></div>
                                    {{-- <div class="stat-heading">Good Receipt</div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <h4><strong>Peminat Berdasarkan Fakultas</strong></h4>
        <hr>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                            <select class="form-control form-control-sm form-select col-4 right" name="vendor">
                                <option value="">-- Choose Years -- </option>
                                        <option value="">2023</option>
                            </select>
                        <div id="jumlah"></div>
                    </div>
                </div>
            </div>

        </div>
        </div>
        <!-- /Widgets -->
        <!--  Traffic  -->

        <!-- /#add-category -->
    </div>
    <!-- .animated -->
</div>
<!-- /.content -->
<div class="clearfix"></div>
<!-- Footer -->

<!-- /.site-footer -->
</div>
<!-- /#right-panel -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
Highcharts.chart('jumlah', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Peminat berdasarkan fakultas',
    align: 'center'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
      }
    }
  },
  series: [{
    name: 'Brands',
    colorByPoint: true,
    data: [{
      name: 'FITE',
      y: 70.67,
      sliced: true,
      selected: true
    }, {
      name: 'FTI',
      y: 14.77
    },  {
      name: 'FB',
      y: 4.86
    }, {
      name: 'Vokasi',
      y: 2.63
    }, ]
  }]
});
</script>
@endsection