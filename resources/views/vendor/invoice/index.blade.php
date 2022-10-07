<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

@extends('vendor.layouts.sidebar')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

<link rel="stylesheet" href="{{asset('assets/css/argon-dashboard.css')}}">
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Invoice List</a></li>
                            <li class="active">Show</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if($message = Session::get('destroy'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{$message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @elseif($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{$message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @elseif($message = Session::get('warning'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{$message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="card-header">
                        <strong class="card-title">Invoice List</strong>
                    </div>
                    <div class="table-stats order-table ov-h">
                        <table id="list" class="table">
                            <thead>
                                <tr>
                                    <th class="serial">No</th>
                                    <th>GR Number</th>
                                    <th>Invoice date</th>
                                    <th>Invoice number</th>
                                    <th>tax invoice number</th>
                                    {{-- <th>e-verify number</th> --}}
                                    <th>Total price</th>
                                    <th>status sap</th>
                                    
                                    <!-- <th class="text-center">Reference</th> -->
                                    <!-- <th class="text-center">Vendor Part Number</th>
                                            <th class="text-center">Item Description</th>
                                            <th class="text-center">UoM</th>
                                            <th class="text-center">Currency</th>
                                            <th class="text-center">Harga Satuan</th>
                                            <th class="text-center">Jumlah</th> -->
                                    <!-- <th class="text-center">Jumlah Harga</th> -->
                                    {{-- <th class="text-center">Tax Code</th> --}}
                                    <!-- <th class="text-center">Valuation Type</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($invoice as $item)
                                <tr>
                                    <td class="serial">{{++$i}}</td>
                                    <td>{{$item['id_gr'] }}</td>
                                    <td>{{$item['posting_date'] }}</td>
                                    <td>{{$item['vendor_invoice_number'] }}</td>
                                    {{-- <td>{{$item['everify_number'] }}</td> --}}
                                    <td>{{$item['faktur_pajak_number'] }}</td>
                                    <td>{{$item['total_harga_everify'] }}</td>
                                    <td>{{$item['status']}}</td>
                                    <td>
                                        <a href="/vendor/detail-invoice/{{$item->id}}" class="btn btn-info">Detail</a>
                                    </td>
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                        &nbsp;&nbsp;&nbsp;<a href="" class="btn btn-success mb-2">Upload SAP</a>
                        {{-- <div class="row">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="col-md-1 mb-2"><a href=""
                                    class="btn btn-primary">Upload SAP</a></div>
                        </div> --}}
                    </div> <!-- /.table-stats -->
                </div>
            </div>
        </div>
    </div>

</div>
</div><!-- .animated -->
</div><!-- .content -->

<div class="clearfix"></div>

<footer class="site-footer">
    <div class="footer-inner bg-white">
        <div class="row">
            <div class="col-sm-6">
                <!-- Copyright &copy; 2018 Ela Admin -->
            </div>
            <div class="col-sm-6 text-right">
                Designed by <a href="https://colorlib.com">Colorlib</a>
            </div>
        </div>
    </div>
</footer>

</div><!-- /#right-panel -->

<script type="text/javascript">
$(document).ready(function() {
    $('#list').DataTable({
        buttons: ['copy', 'csv', 'excel', 'print'],
        dom: "<'row'<'col-md-2 bg-white'l><'col-md-5 bg-white'B><'col-md-5 bg-white'f>>" +
            "<'row'<'col-md-12'tr>>" +
            "<'row'<'col-md-6'i><'col-md-6'p>>",
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ]
    });

});

function checkAll(box) {
    let checkboxes = document.getElementsByTagName('input');

    if (box.checked) { // jika checkbox teratar dipilih maka semua tag input juga dipilih
        for (let i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == 'checkbox') {
                checkboxes[i].checked = true;
            }
        }
    } else { // jika checkbox teratas tidak dipilih maka semua tag input juga tidak dipilih
        for (let i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == 'checkbox') {
                checkboxes[i].checked = false;
            }
        }
    }
}

function showHide(sID){
	var el = document.getElementById(sID);
	if(el) {
		el.style.display = (el.style.display === '') ? 'none' : '';
	}
}
</script>
@endsection