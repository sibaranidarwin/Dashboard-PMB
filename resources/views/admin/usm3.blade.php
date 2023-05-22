@extends('admin.layouts.app')
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

<div class="content">
    <!-- Animated -->


    <h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;USM 3</strong></h4>
        <hr>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                            <select class="form-control form-control-sm form-select col-4 right" name="vendor">
                                <option value="">-- Choose Years -- </option>
                                        <option value="">2023</option>
                            </select>
                        <div id="jumlah1"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                            <select class="form-control form-control-sm form-select col-4 right" name="vendor">
                                <option value="">-- Choose Years -- </option>
                                        <option value="">2023</option>
                            </select>
                        <div id="jumlah2"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                            <select class="form-control form-control-sm form-select col-4 right" name="vendor">
                                <option value="">-- Choose Years -- </option>
                                        <option value="">2023</option>
                            </select>
                        <div id="jumlah3"></div>
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
    Highcharts.setOptions({
        lang: {
          thousandsSep: ' '
        },
        colors: [ '#779bd9','#2750a8']
      })
      Highcharts.chart('jumlah1', {
          chart: {
              type: 'column',
              zoomType: 'y',
              //backgroundColor:"#FBFAE4"
          },
          title: {
              text: 'Pilihan 1'
          },
          xAxis: {
            categories: [
              'D3 TI',
              'D3 TK',
              'D4 TRPL',
              'S1 MR',
              'S1 IF',
              'S1 TB',
              'S1 TE',
              'S1 SI'
          ],
              crosshair: true
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Total Mahasiswa'
              }
          },
          tooltip: {
                  headerFormat: '<span style="font-size:10px"><b>{point.key}</b></span><table>',
                  pointFormat: '<tr><td style="color:{series.color};padding:0"> </td>' +
                      '<td style="padding:0"><b>{point.y:,.0f}</b></td></tr>' + 'Jumlah: <b>{point.count:,.1f}</b><br/>',
                  footerFormat: '</table>',
                  shared: true,
                  useHTML: true
              },
          plotOptions: {
              column: {
                  pointPadding: 0.2,
                  borderWidth: 0,
                  dataLabels: {
                                enabled: true,
                                format: '{point.y:,.0f}'
                            }
              }
          },
          colors: [
            ' #000080',
            ],
          series: [{
              showInLegend: false,
              data: [56, 100, 120, 100,56, 100, 120, 100],

          },],


      });
      </script>
    <script>
        Highcharts.setOptions({
            lang: {
              thousandsSep: ' '
            },
            colors: [ '#779bd9','#2750a8']
          })
          Highcharts.chart('jumlah2', {
              chart: {
                  type: 'column',
                  zoomType: 'y',
                  //backgroundColor:"#FBFAE4"
              },
              title: {
                  text: 'Pilihan 2'
              },
              xAxis: {
                categories: [
                  'D3 TI',
                  'D3 TK',
                  'D4 TRPL',
                  'S1 MR',
                  'S1 IF',
                  'S1 TB',
                  'S1 TE',
                  'S1 SI'
              ],
                  crosshair: true
              },
              yAxis: {
                  min: 0,
                  title: {
                      text: 'Total Mahasiswa'
                  }
              },
              tooltip: {
                  headerFormat: '<span style="font-size:10px"><b>{point.key}</b></span><table>',
                  pointFormat: '<tr><td style="color:{series.color};padding:0"> </td>' +
                      '<td style="padding:0"><b>{point.y:,.0f}</b></td></tr>' + 'Jumlah: <b>{point.count:,.1f}</b><br/>',
                  footerFormat: '</table>',
                  shared: true,
                  useHTML: true
              },
              plotOptions: {
                  column: {
                      pointPadding: 0.2,
                      borderWidth: 0,
                      dataLabels: {
                                    enabled: true,
                                    format: '{point.y:,.0f}'
                                }
                  }
              },
              colors: [
            ' #000080',
            ],
              series: [{
                 showInLegend: false,
                  data: [56, 100, 120, 100,56, 100, 120, 100],

              },],


          });
          </script>
         <script>
            Highcharts.setOptions({
                lang: {
                  thousandsSep: ' '
                },
                colors: [ '#779bd9','#2750a8']
              })
              Highcharts.chart('jumlah3', {
                  chart: {
                      type: 'column',
                      zoomType: 'y',
                      //backgroundColor:"#FBFAE4"
                  },
                  title: {
                      text: 'Pilihan 3'
                  },
                  xAxis: {
                    categories: [
                      'D3 TI',
                      'D3 TK',
                      'D4 TRPL',
                      'S1 MR',
                      'S1 IF',
                      'S1 TB',
                      'S1 TE',
                      'S1 SI'
                  ],
                      crosshair: true
                  },
                  yAxis: {
                      min: 0,
                      title: {
                          text: 'Total Mahasiswa'
                      }
                  },
                  tooltip: {
                  headerFormat: '<span style="font-size:10px"><b>{point.key}</b></span><table>',
                  pointFormat: '<tr><td style="color:{series.color};padding:0"> </td>' +
                      '<td style="padding:0"><b>{point.y:,.0f}</b></td></tr>' + 'Jumlah: <b>{point.count:,.1f}</b><br/>',
                  footerFormat: '</table>',
                  shared: true,
                  useHTML: true
              },
                  plotOptions: {
                      column: {
                          pointPadding: 0.2,
                          borderWidth: 0,
                          dataLabels: {
                                        enabled: true,
                                        format: '{point.y:,.0f}'
                                    }
                      }
                  },
                  colors: [
                    '#000080',
                    ],
                  series: [{
                    showInLegend: false,
                      data: [56, 100, 120, 100,56, 100, 120, 100],

                  },],


              });
              </script>
@endsection
