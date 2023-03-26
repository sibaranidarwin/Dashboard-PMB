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
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dashboard Mahasiswa Baru</strong></h4>
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
Highcharts.setOptions({
    lang: {
      thousandsSep: ' '
    },
    colors: [ '#779bd9','#2750a8']
  })
  Highcharts.chart('jumlah', {
      chart: {
          type: 'column',
          zoomType: 'y',
          //backgroundColor:"#FBFAE4"
      },
      title: {
          text: 'Grafik Mahasiswa Baru'
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
              pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y:,.0f}M</b></td></tr>' + 'Count: <b>{point.count:,.1f}</b><br/>',
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
      series: [{
          name: 'Jumlah Pendaftar',
          data: [56, 100, 120, 100, 200, 203, 200, 300],
  
      }, {
          name: 'Jumlah Lulus',
          data: [100, 120,130, 121, 140, 139, 129, 430],
  
      },],
      
     
  });
  </script>

<script>
$('#myModal').on('shown.bs.modal', function () {
$('#myInput').trigger('focus')
})
</script>
@endsection