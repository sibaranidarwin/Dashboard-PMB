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

table, td, th {
  border: 1px solid;
}

table {
  width: 100%;
  border-collapse: collapse;
}
</style>

<div class="content">
    <!-- Animated -->


    <h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Akreditasi Program Studi</strong></h4>
        <hr>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table>
                            <tr>
                              <th>Fakultas</th>
                              <th>Prodi</th>
                              <th>Akreditasi</th>
                            </tr>
                            <tr>
                              <td rowspan="3">FITE</td>
                              <td>S1 IF</td>
                              <td>C</td>
                            </tr>
                            <tr>
                              <td>S1 SI</td>
                              <td>C</td>
                            </tr>
                            <tr>
                                <td>S1 TE</td>
                                <td>B</td>
                              </tr>
                              <tr>
                                <td rowspan="1">FTI</td>
                                <td>S1 MR</td>
                                <td>C</td>
                              </tr>
                              <tr>
                                <td rowspan="1">FB</td>
                                <td>S1 TB</td>
                                <td>C</td>
                              </tr>
                              <tr>
                                <td rowspan="3">Vokasi</td>
                                <td>D4 TRPL</td>
                                <td>B</td>
                              </tr>
                              <tr>
                                <td>D3 TI</td>
                                <td>B</td>
                              </tr>
                              <tr>
                                <td>D3 TK</td>
                                <td>B</td>
                              </tr>
                          </table>
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
Highcharts.chart('jumlah1', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: '5 Asal Sekolah Peminat Tertinggi',
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
      name: 'SMA N 1 Laguboti',
      y: 70.67,
      sliced: true,
      selected: true
    }, {
      name: 'SMA N 1 Balige',
      y: 14.77
    },  {
      name: 'SMA N 2 Balige',
      y: 4.86
    },{
      name: 'SMAS BTB',
      y: 7.86
    }, {
      name: 'SMA N 1 Narumonda',
      y: 10.86
    },]
  }]
});
</script>
@endsection
