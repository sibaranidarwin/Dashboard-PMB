<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use App\BA_Reconcile;
use App\Draft_BA;
use App\good_receipt;
use App\Invoice;
use PDF; //library pdf

use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $good_receipt = good_receipt::count();
        $invoicegr = Invoice::all()->where("data_from", "GR")->count();
        $invoiceba = Invoice::all()->where("data_from", "BA")->count();
        $dispute = good_receipt::all()->where("Status", "Dispute")->count();
        $vendor = User::all()->where("level", "vendor")->count();
        $draft = Draft_BA::count();
        $ba = BA_Reconcile::count();

        return view('admin.dashboard',['good_receipt'=>$good_receipt,'draft'=>$draft, 'ba'=>$ba , 'invoicegr'=>$invoicegr, 'invoiceba'=>$invoiceba, 'dispute'=>$dispute, 'vendor'=>$vendor]);
    }

    public function all()
    {

        $good_receipts = good_receipt::where("status", "Verified")->orwhere('status', '!=', 'Not Verified')->orwhere('material_number','LG2KOM00707010F691')->orwhere("status", "Rejected")->get();
        $vendor_name = good_receipt::select('vendor_name')->distinct()->get();
        $start_date = null;
        $end_date = null;
        $vendor = null;

        $dispute = good_receipt::all()->where("status", "Disputed")->count();

        return view('admin.po.all',compact('good_receipts', 'dispute', 'vendor_name', 'start_date', 'end_date', 'vendor'))
                ->with('i',(request()->input('page', 1) -1) *5);
    }
    public function po()
    {
        $good_receipts = good_receipt::where('material_number', 'LG2KOM00707010F691' )->WhereNull('status')->get();
        $start_date = null;
        $end_date = null;
        $status = null;
        $vendor = null;

        $vendor_name = good_receipt::select('vendor_name')->distinct()->get();

        return view('admin.po.notver',compact('good_receipts', 'vendor_name', 'start_date', 'end_date', 'status', 'vendor'))
                ->with('i',(request()->input('page', 1) -1) *5);
    }

    public function pover()
    {
        $good_receipts = good_receipt::where("Status","Verified")->get();
        $start_date = null;
        $end_date = null;
        $status = null;
        $vendor = null;

        $vendor_name = good_receipt::select('vendor_name')->distinct()->get();

        return view('admin.po.ver',compact('good_receipts', 'vendor_name', 'start_date', 'end_date', 'status', 'vendor'))
                ->with('i',(request()->input('page', 1) -1) *5);
    }

    public function poreject()
    {
        $good_receipts = good_receipt::where("status","Rejected")->get();
        $start_date = null;
        $end_date = null;
        $status = null;
        $vendor = null;

        $vendor_name = good_receipt::select('vendor_name')->distinct()->get();

        return view('admin.po.reject',compact('good_receipts', 'vendor_name', 'start_date', 'end_date', 'status', 'vendor'))
                ->with('i',(request()->input('page', 1) -1) *5);
    }

    public function disputed()
    {
        $good_receipts = good_receipt::where("Status", "Disputed")->get();
        $start_date = null;
        $end_date = null;
        $status = null;
        $vendor = null;
        $vendor_name = good_receipt::select('vendor_name')->distinct()->get();


        return view('admin.po.disputed',compact('good_receipts', 'start_date', 'end_date', 'vendor_name', 'status', 'vendor'))
                ->with('i',(request()->input('page', 1) -1) *5);
    }

    public function historydraft()
    {
    $draft = Draft_BA::all();
    return view('admin.ba.historydraft',compact('draft'));
    }
    public function draft()
    {
    $draft = Draft_BA::all();
    return view('admin.ba.draft',compact('draft'));
    }

    public function ba()
    {
        $ba = BA_Reconcile::all()->where("status_invoice_proposal", "Not Yet Verified - BA");

        return view('admin.ba.index',compact('ba'));
    }
    public function historyba()
    {
        $user_vendor = Auth::User()->id_vendor;

        $ba = BA_Reconcile::all()->where("status_invoice_proposal", "Verified");

        return view('admin.ba.historyba',compact('ba'));
    }

    public function invoice()
    {
        $invoice = Invoice::latest()->orWhere("data_from", "GR")->get();
        $start_date = null;
        $end_date = null;
        $status = null;

        return view('admin.invoice.index',compact('invoice', 'start_date', 'end_date', 'status'))
                ->with('i',(request()->input('page', 1) -1) *5);

    }
    public function detailinvoice(Request $request, $id){
        $detail = Invoice::find($id);
        $invoices = good_receipt::select("goods_receipt.id_gr",
                                    "goods_receipt.no_po",
                                    "goods_receipt.gr_number",
                                    "goods_receipt.po_item",
                                    "goods_receipt.gr_date",
                                    "goods_receipt.material_number",
                                    "goods_receipt.harga_satuan",
                                    "goods_receipt.jumlah",
                                    "goods_receipt.tax_code",
                                    "goods_receipt.status",
                                    "invoice.id_inv",
                                    "invoice.posting_date",
                                    "invoice.baselinedate",
                                    "invoice.vendor_invoice_number",
                                    "invoice.faktur_pajak_number",
                                    "invoice.total_harga_everify",
                                    "invoice.ppn",
                                    "invoice.no_invoice_proposal",
                                    "invoice.del_costs",
                                    "invoice.total_harga_gross",
                                    "invoice.created_at"
                                    )
                                    ->JOIN("invoice", "goods_receipt.id_inv", "=", "invoice.id_inv")
                                    ->where("invoice.id_inv", "=", "$detail->id_inv")
                                    ->get();

        return view('admin.invoice.detail', compact('invoices'))->with('i',(request()->input('page', 1) -1) *5);
    }

    public function invoiceba()
    {
        $invoice = Invoice::latest()->orWhere("data_from", "BA")->get();
        $start_date = null;
        $end_date = null;
        $status = null;

        return view('admin.invoice.indexba',compact('invoice', 'start_date', 'end_date', 'status'))
                ->with('i',(request()->input('page', 1) -1) *5);
    }

    public function detailinvoiceba(Request $request, $id){
        $detail = Invoice::find($id);
        // dd($detail->id_inv);
        $invoices = BA_Reconcile::select("ba_reconcile.id_ba",
        "ba_reconcile.no_ba",
        "ba_reconcile.po_number",
        "ba_reconcile.gr_number",
        "ba_reconcile.material_number",
        "ba_reconcile.vendor_part_number",
        "ba_reconcile.item",
        "ba_reconcile.gr_date",
        "ba_reconcile.harga_satuan",
        "ba_reconcile.qty",
        "ba_reconcile.valuation_type",
        "ba_reconcile.uom",
        "ba_reconcile.tax_code",
        "ba_reconcile.material_description",
        "ba_reconcile.status_ba",
        "invoice.id_inv",
        "invoice.posting_date",
        "invoice.baselinedate",
        "invoice.vendor_invoice_number",
        "invoice.no_invoice_proposal",
        "invoice.faktur_pajak_number",
        "invoice.total_harga_everify",
        "invoice.ppn",
        "invoice.del_costs",
        "invoice.total_harga_gross",
        "invoice.created_at"
        )
        ->JOIN("invoice", "ba_reconcile.id_inv", "=", "invoice.id_inv")
        ->where("invoice.id_inv", "=", "$detail->id_inv")
        ->get();

        return view('admin.invoice.detailba', compact('invoices'))->with('i',(request()->input('page', 1) -1) *5);
    }
    public function cetak_pdf($id)
    {
                    $detail = Invoice::find($id);
                    $invoices = good_receipt::select("goods_receipt.id_gr",
                    "goods_receipt.no_po",
                    "goods_receipt.gr_number",
                    "goods_receipt.po_item",
                    "goods_receipt.gr_date",
                    "goods_receipt.material_number",
                    "goods_receipt.harga_satuan",
                    "goods_receipt.jumlah",
                    "goods_receipt.tax_code",
                    "goods_receipt.status",
                    "invoice.id_inv",
                    "invoice.posting_date",
                    "invoice.baselinedate",
                    "invoice.vendor_invoice_number",
                    "invoice.faktur_pajak_number",
                    "invoice.total_harga_everify",
                    "invoice.ppn",
                    "invoice.del_costs",
                    "invoice.total_harga_gross",
                    "invoice.created_at"
                    )
                    ->JOIN("invoice", "goods_receipt.id_inv", "=", "invoice.id_inv")
                    ->where("invoice.id_inv", "=", "$detail->id_inv")
                    ->get();

                    $pdf = PDF::loadView('admin.invoice.print',compact('invoices'))->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape');
                    $pdf->save(storage_path().'invoice.pdf');
                    return $pdf->stream();
    }
    public function cetak_pdf_ba($id)
    {
        $detail = Invoice::find($id);
        $invoices = BA_Reconcile::select("ba_reconcile.id_ba",
        "ba_reconcile.no_ba",
        "ba_reconcile.po_number",
        "ba_reconcile.po_mkp",
        "ba_reconcile.gr_date",
        "ba_reconcile.material_bp",
        "ba_reconcile.status_ba",
        "invoice.id_inv",
        "invoice.posting_date",
        "invoice.baselinedate",
        "invoice.vendor_invoice_number",
        "invoice.faktur_pajak_number",
        "invoice.total_harga_everify",
        "invoice.ppn",
        "invoice.del_costs",
        "invoice.total_harga_gross",
        "invoice.created_at"
        )
        ->JOIN("invoice", "ba_reconcile.id_inv", "=", "invoice.id_inv")
        ->where("invoice.id_inv", "=", "$detail->id_inv")
        ->get();

                    $pdf = PDF::loadView('admin.invoice.printba',compact('invoices'))->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape');
                    $pdf->save(storage_path().'invoice.pdf');
                    return $pdf->stream();
    }


    /**
     * Show the form for creating a new resource.
     *
 * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pmdk()
    {
        $user_vendor = Auth::User()->id_vendor;
        $user_vendor2 = Auth::User()->name;
        $name = Auth::User()->name;
        $a = date('Y-m-d');
        $b = date('Y-m-d',strtotime('+1 days'));
        $range = [$a, $b];

        $good_receipt = good_receipt::where('id_vendor', $user_vendor)->where('id_inv',0)->orwhere('status','Auto Verify')->where(function($query) {
			$query->where('status','Verified')
            ->orWhereNull('status');})->count();
            $year = CarbonImmutable::now()->locale('id_ID')->format('Y');
            $month = 1;
            $date = \Carbon\Carbon::parse($year."-".$month."-01"); // universal truth month's first day is 1
            $start = $date->startOfMonth()->format('Y-m-d H:i:s'); // 2000-02-01 00:00:00
            $end = $date->endOfMonth()->format('Y-m-d H:i:s');
            $invgr =Invoice::whereBetween('created_at', [$start, $end])->where("data_from", "GR")->sum('total_harga_everify');
            $invba =Invoice::whereBetween('created_at', [$start, $end])->where("data_from", "BA")->sum('total_harga_everify');
            // dd($invgr);

            $year = CarbonImmutable::now()->locale('id_ID')->format('Y');
            $invthngr =Invoice::whereYear('created_at', $year)->where("data_from", "GR")->sum('total_harga_everify');
            $invthnba =Invoice::whereYear('created_at', $year)->where("data_from", "BA")->sum('total_harga_everify');

        $invoicegr = Invoice::all()->where("data_from", "GR")->Where("id_vendor", $user_vendor)->count();
        $invoiceba = Invoice::all()->where("data_from", "BA")->Where("id_vendor", $user_vendor)->count();
        $dispute = good_receipt::all()->where("status", "Disputed")->Where("vendor_name", $user_vendor2)->count();
        $notif = good_receipt::all()->where("status", "Disputed")->Where("vendor_name", $name)->whereBetween('updated_at', $range)->count();
        $vendor = User::all()->where("level", "vendor")->count();
        $draft = Draft_BA::all()->Where("id_vendor", $user_vendor)->count();
        $ba = BA_Reconcile::all()->Where("id_vendor", $user_vendor)->count();
        $month = null;
        $year = null;

        return view('admin.pmdk',['month'=>$month, 'year'=>$year, 'good_receipt'=>$good_receipt,'draft'=>$draft, 'ba'=>$ba , 'invoicegr'=>$invoicegr, 'invoiceba'=>$invoiceba, 'dispute'=>$dispute, 'vendor'=>$vendor, 'notif'=>$notif, 'invgr'=>$invgr, 'invba'=>$invba, 'invthngr'=>$invthngr, 'invthnba'=>$invthnba]);
    }

    public function usm1()
    {
        $user_vendor = Auth::User()->id_vendor;
        $user_vendor2 = Auth::User()->name;
        $name = Auth::User()->name;
        $a = date('Y-m-d');
        $b = date('Y-m-d',strtotime('+1 days'));
        $range = [$a, $b];

        $good_receipt = good_receipt::where('id_vendor', $user_vendor)->where('id_inv',0)->orwhere('status','Auto Verify')->where(function($query) {
			$query->where('status','Verified')
            ->orWhereNull('status');})->count();
            $year = CarbonImmutable::now()->locale('id_ID')->format('Y');
            $month = 1;
            $date = \Carbon\Carbon::parse($year."-".$month."-01"); // universal truth month's first day is 1
            $start = $date->startOfMonth()->format('Y-m-d H:i:s'); // 2000-02-01 00:00:00
            $end = $date->endOfMonth()->format('Y-m-d H:i:s');
            $invgr =Invoice::whereBetween('created_at', [$start, $end])->where("data_from", "GR")->sum('total_harga_everify');
            $invba =Invoice::whereBetween('created_at', [$start, $end])->where("data_from", "BA")->sum('total_harga_everify');
            // dd($invgr);

            $year = CarbonImmutable::now()->locale('id_ID')->format('Y');
            $invthngr =Invoice::whereYear('created_at', $year)->where("data_from", "GR")->sum('total_harga_everify');
            $invthnba =Invoice::whereYear('created_at', $year)->where("data_from", "BA")->sum('total_harga_everify');

        $invoicegr = Invoice::all()->where("data_from", "GR")->Where("id_vendor", $user_vendor)->count();
        $invoiceba = Invoice::all()->where("data_from", "BA")->Where("id_vendor", $user_vendor)->count();
        $dispute = good_receipt::all()->where("status", "Disputed")->Where("vendor_name", $user_vendor2)->count();
        $notif = good_receipt::all()->where("status", "Disputed")->Where("vendor_name", $name)->whereBetween('updated_at', $range)->count();
        $vendor = User::all()->where("level", "vendor")->count();
        $draft = Draft_BA::all()->Where("id_vendor", $user_vendor)->count();
        $ba = BA_Reconcile::all()->Where("id_vendor", $user_vendor)->count();
        $month = null;
        $year = null;

        return view('admin.usm1',['month'=>$month, 'year'=>$year, 'good_receipt'=>$good_receipt,'draft'=>$draft, 'ba'=>$ba , 'invoicegr'=>$invoicegr, 'invoiceba'=>$invoiceba, 'dispute'=>$dispute, 'vendor'=>$vendor, 'notif'=>$notif, 'invgr'=>$invgr, 'invba'=>$invba, 'invthngr'=>$invthngr, 'invthnba'=>$invthnba]);
    }

    public function usm2()
    {
        $user_vendor = Auth::User()->id_vendor;
        $user_vendor2 = Auth::User()->name;
        $name = Auth::User()->name;
        $a = date('Y-m-d');
        $b = date('Y-m-d',strtotime('+1 days'));
        $range = [$a, $b];

        $good_receipt = good_receipt::where('id_vendor', $user_vendor)->where('id_inv',0)->orwhere('status','Auto Verify')->where(function($query) {
			$query->where('status','Verified')
            ->orWhereNull('status');})->count();
            $year = CarbonImmutable::now()->locale('id_ID')->format('Y');
            $month = 1;
            $date = \Carbon\Carbon::parse($year."-".$month."-01"); // universal truth month's first day is 1
            $start = $date->startOfMonth()->format('Y-m-d H:i:s'); // 2000-02-01 00:00:00
            $end = $date->endOfMonth()->format('Y-m-d H:i:s');
            $invgr =Invoice::whereBetween('created_at', [$start, $end])->where("data_from", "GR")->sum('total_harga_everify');
            $invba =Invoice::whereBetween('created_at', [$start, $end])->where("data_from", "BA")->sum('total_harga_everify');
            // dd($invgr);

            $year = CarbonImmutable::now()->locale('id_ID')->format('Y');
            $invthngr =Invoice::whereYear('created_at', $year)->where("data_from", "GR")->sum('total_harga_everify');
            $invthnba =Invoice::whereYear('created_at', $year)->where("data_from", "BA")->sum('total_harga_everify');

        $invoicegr = Invoice::all()->where("data_from", "GR")->Where("id_vendor", $user_vendor)->count();
        $invoiceba = Invoice::all()->where("data_from", "BA")->Where("id_vendor", $user_vendor)->count();
        $dispute = good_receipt::all()->where("status", "Disputed")->Where("vendor_name", $user_vendor2)->count();
        $notif = good_receipt::all()->where("status", "Disputed")->Where("vendor_name", $name)->whereBetween('updated_at', $range)->count();
        $vendor = User::all()->where("level", "vendor")->count();
        $draft = Draft_BA::all()->Where("id_vendor", $user_vendor)->count();
        $ba = BA_Reconcile::all()->Where("id_vendor", $user_vendor)->count();
        $month = null;
        $year = null;

        return view('admin.usm2',['month'=>$month, 'year'=>$year, 'good_receipt'=>$good_receipt,'draft'=>$draft, 'ba'=>$ba , 'invoicegr'=>$invoicegr, 'invoiceba'=>$invoiceba, 'dispute'=>$dispute, 'vendor'=>$vendor, 'notif'=>$notif, 'invgr'=>$invgr, 'invba'=>$invba, 'invthngr'=>$invthngr, 'invthnba'=>$invthnba]);
    }

    public function usm3()
    {
        $user_vendor = Auth::User()->id_vendor;
        $user_vendor2 = Auth::User()->name;
        $name = Auth::User()->name;
        $a = date('Y-m-d');
        $b = date('Y-m-d',strtotime('+1 days'));
        $range = [$a, $b];

        $good_receipt = good_receipt::where('id_vendor', $user_vendor)->where('id_inv',0)->orwhere('status','Auto Verify')->where(function($query) {
			$query->where('status','Verified')
            ->orWhereNull('status');})->count();
            $year = CarbonImmutable::now()->locale('id_ID')->format('Y');
            $month = 1;
            $date = \Carbon\Carbon::parse($year."-".$month."-01"); // universal truth month's first day is 1
            $start = $date->startOfMonth()->format('Y-m-d H:i:s'); // 2000-02-01 00:00:00
            $end = $date->endOfMonth()->format('Y-m-d H:i:s');
            $invgr =Invoice::whereBetween('created_at', [$start, $end])->where("data_from", "GR")->sum('total_harga_everify');
            $invba =Invoice::whereBetween('created_at', [$start, $end])->where("data_from", "BA")->sum('total_harga_everify');
            // dd($invgr);

            $year = CarbonImmutable::now()->locale('id_ID')->format('Y');
            $invthngr =Invoice::whereYear('created_at', $year)->where("data_from", "GR")->sum('total_harga_everify');
            $invthnba =Invoice::whereYear('created_at', $year)->where("data_from", "BA")->sum('total_harga_everify');

        $invoicegr = Invoice::all()->where("data_from", "GR")->Where("id_vendor", $user_vendor)->count();
        $invoiceba = Invoice::all()->where("data_from", "BA")->Where("id_vendor", $user_vendor)->count();
        $dispute = good_receipt::all()->where("status", "Disputed")->Where("vendor_name", $user_vendor2)->count();
        $notif = good_receipt::all()->where("status", "Disputed")->Where("vendor_name", $name)->whereBetween('updated_at', $range)->count();
        $vendor = User::all()->where("level", "vendor")->count();
        $draft = Draft_BA::all()->Where("id_vendor", $user_vendor)->count();
        $ba = BA_Reconcile::all()->Where("id_vendor", $user_vendor)->count();
        $month = null;
        $year = null;

        return view('admin.usm3',['month'=>$month, 'year'=>$year, 'good_receipt'=>$good_receipt,'draft'=>$draft, 'ba'=>$ba , 'invoicegr'=>$invoicegr, 'invoiceba'=>$invoiceba, 'dispute'=>$dispute, 'vendor'=>$vendor, 'notif'=>$notif, 'invgr'=>$invgr, 'invba'=>$invba, 'invthngr'=>$invthngr, 'invthnba'=>$invthnba]);
    }

    public function utbk()
    {
        $user_vendor = Auth::User()->id_vendor;
        $user_vendor2 = Auth::User()->name;
        $name = Auth::User()->name;
        $a = date('Y-m-d');
        $b = date('Y-m-d',strtotime('+1 days'));
        $range = [$a, $b];

        $good_receipt = good_receipt::where('id_vendor', $user_vendor)->where('id_inv',0)->orwhere('status','Auto Verify')->where(function($query) {
			$query->where('status','Verified')
            ->orWhereNull('status');})->count();
            $year = CarbonImmutable::now()->locale('id_ID')->format('Y');
            $month = 1;
            $date = \Carbon\Carbon::parse($year."-".$month."-01"); // universal truth month's first day is 1
            $start = $date->startOfMonth()->format('Y-m-d H:i:s'); // 2000-02-01 00:00:00
            $end = $date->endOfMonth()->format('Y-m-d H:i:s');
            $invgr =Invoice::whereBetween('created_at', [$start, $end])->where("data_from", "GR")->sum('total_harga_everify');
            $invba =Invoice::whereBetween('created_at', [$start, $end])->where("data_from", "BA")->sum('total_harga_everify');
            // dd($invgr);

            $year = CarbonImmutable::now()->locale('id_ID')->format('Y');
            $invthngr =Invoice::whereYear('created_at', $year)->where("data_from", "GR")->sum('total_harga_everify');
            $invthnba =Invoice::whereYear('created_at', $year)->where("data_from", "BA")->sum('total_harga_everify');

        $invoicegr = Invoice::all()->where("data_from", "GR")->Where("id_vendor", $user_vendor)->count();
        $invoiceba = Invoice::all()->where("data_from", "BA")->Where("id_vendor", $user_vendor)->count();
        $dispute = good_receipt::all()->where("status", "Disputed")->Where("vendor_name", $user_vendor2)->count();
        $notif = good_receipt::all()->where("status", "Disputed")->Where("vendor_name", $name)->whereBetween('updated_at', $range)->count();
        $vendor = User::all()->where("level", "vendor")->count();
        $draft = Draft_BA::all()->Where("id_vendor", $user_vendor)->count();
        $ba = BA_Reconcile::all()->Where("id_vendor", $user_vendor)->count();
        $month = null;
        $year = null;

        return view('admin.utbk',['month'=>$month, 'year'=>$year, 'good_receipt'=>$good_receipt,'draft'=>$draft, 'ba'=>$ba , 'invoicegr'=>$invoicegr, 'invoiceba'=>$invoiceba, 'dispute'=>$dispute, 'vendor'=>$vendor, 'notif'=>$notif, 'invgr'=>$invgr, 'invba'=>$invba, 'invthngr'=>$invthngr, 'invthnba'=>$invthnba]);
    }

    public function prodi()
    {
        $user_vendor = Auth::User()->id_vendor;
        $user_vendor2 = Auth::User()->name;
        $name = Auth::User()->name;
        $a = date('Y-m-d');
        $b = date('Y-m-d',strtotime('+1 days'));
        $range = [$a, $b];

        $good_receipt = good_receipt::where('id_vendor', $user_vendor)->where('id_inv',0)->orwhere('status','Auto Verify')->where(function($query) {
			$query->where('status','Verified')
            ->orWhereNull('status');})->count();
            $year = CarbonImmutable::now()->locale('id_ID')->format('Y');
            $month = 1;
            $date = \Carbon\Carbon::parse($year."-".$month."-01"); // universal truth month's first day is 1
            $start = $date->startOfMonth()->format('Y-m-d H:i:s'); // 2000-02-01 00:00:00
            $end = $date->endOfMonth()->format('Y-m-d H:i:s');
            $invgr =Invoice::whereBetween('created_at', [$start, $end])->where("data_from", "GR")->sum('total_harga_everify');
            $invba =Invoice::whereBetween('created_at', [$start, $end])->where("data_from", "BA")->sum('total_harga_everify');
            // dd($invgr);

            $year = CarbonImmutable::now()->locale('id_ID')->format('Y');
            $invthngr =Invoice::whereYear('created_at', $year)->where("data_from", "GR")->sum('total_harga_everify');
            $invthnba =Invoice::whereYear('created_at', $year)->where("data_from", "BA")->sum('total_harga_everify');

        $invoicegr = Invoice::all()->where("data_from", "GR")->Where("id_vendor", $user_vendor)->count();
        $invoiceba = Invoice::all()->where("data_from", "BA")->Where("id_vendor", $user_vendor)->count();
        $dispute = good_receipt::all()->where("status", "Disputed")->Where("vendor_name", $user_vendor2)->count();
        $notif = good_receipt::all()->where("status", "Disputed")->Where("vendor_name", $name)->whereBetween('updated_at', $range)->count();
        $vendor = User::all()->where("level", "vendor")->count();
        $draft = Draft_BA::all()->Where("id_vendor", $user_vendor)->count();
        $ba = BA_Reconcile::all()->Where("id_vendor", $user_vendor)->count();
        $month = null;
        $year = null;

        return view('admin.prodi',['month'=>$month, 'year'=>$year, 'good_receipt'=>$good_receipt,'draft'=>$draft, 'ba'=>$ba , 'invoicegr'=>$invoicegr, 'invoiceba'=>$invoiceba, 'dispute'=>$dispute, 'vendor'=>$vendor, 'notif'=>$notif, 'invgr'=>$invgr, 'invba'=>$invba, 'invthngr'=>$invthngr, 'invthnba'=>$invthnba]);
    }

    public function asal()
    {
        $user_vendor = Auth::User()->id_vendor;
        $user_vendor2 = Auth::User()->name;
        $name = Auth::User()->name;
        $a = date('Y-m-d');
        $b = date('Y-m-d',strtotime('+1 days'));
        $range = [$a, $b];

        $good_receipt = good_receipt::where('id_vendor', $user_vendor)->where('id_inv',0)->orwhere('status','Auto Verify')->where(function($query) {
			$query->where('status','Verified')
            ->orWhereNull('status');})->count();
            $year = CarbonImmutable::now()->locale('id_ID')->format('Y');
            $month = 1;
            $date = \Carbon\Carbon::parse($year."-".$month."-01"); // universal truth month's first day is 1
            $start = $date->startOfMonth()->format('Y-m-d H:i:s'); // 2000-02-01 00:00:00
            $end = $date->endOfMonth()->format('Y-m-d H:i:s');
            $invgr =Invoice::whereBetween('created_at', [$start, $end])->where("data_from", "GR")->sum('total_harga_everify');
            $invba =Invoice::whereBetween('created_at', [$start, $end])->where("data_from", "BA")->sum('total_harga_everify');
            // dd($invgr);

            $year = CarbonImmutable::now()->locale('id_ID')->format('Y');
            $invthngr =Invoice::whereYear('created_at', $year)->where("data_from", "GR")->sum('total_harga_everify');
            $invthnba =Invoice::whereYear('created_at', $year)->where("data_from", "BA")->sum('total_harga_everify');

        $invoicegr = Invoice::all()->where("data_from", "GR")->Where("id_vendor", $user_vendor)->count();
        $invoiceba = Invoice::all()->where("data_from", "BA")->Where("id_vendor", $user_vendor)->count();
        $dispute = good_receipt::all()->where("status", "Disputed")->Where("vendor_name", $user_vendor2)->count();
        $notif = good_receipt::all()->where("status", "Disputed")->Where("vendor_name", $name)->whereBetween('updated_at', $range)->count();
        $vendor = User::all()->where("level", "vendor")->count();
        $draft = Draft_BA::all()->Where("id_vendor", $user_vendor)->count();
        $ba = BA_Reconcile::all()->Where("id_vendor", $user_vendor)->count();
        $month = null;
        $year = null;

        return view('admin.asal',['month'=>$month, 'year'=>$year, 'good_receipt'=>$good_receipt,'draft'=>$draft, 'ba'=>$ba , 'invoicegr'=>$invoicegr, 'invoiceba'=>$invoiceba, 'dispute'=>$dispute, 'vendor'=>$vendor, 'notif'=>$notif, 'invgr'=>$invgr, 'invba'=>$invba, 'invthngr'=>$invthngr, 'invthnba'=>$invthnba]);
    }

    public function akreditasi()
    {
        $user_vendor = Auth::User()->id_vendor;
        $user_vendor2 = Auth::User()->name;
        $name = Auth::User()->name;
        $a = date('Y-m-d');
        $b = date('Y-m-d',strtotime('+1 days'));
        $range = [$a, $b];

        $good_receipt = good_receipt::where('id_vendor', $user_vendor)->where('id_inv',0)->orwhere('status','Auto Verify')->where(function($query) {
			$query->where('status','Verified')
            ->orWhereNull('status');})->count();
            $year = CarbonImmutable::now()->locale('id_ID')->format('Y');
            $month = 1;
            $date = \Carbon\Carbon::parse($year."-".$month."-01"); // universal truth month's first day is 1
            $start = $date->startOfMonth()->format('Y-m-d H:i:s'); // 2000-02-01 00:00:00
            $end = $date->endOfMonth()->format('Y-m-d H:i:s');
            $invgr =Invoice::whereBetween('created_at', [$start, $end])->where("data_from", "GR")->sum('total_harga_everify');
            $invba =Invoice::whereBetween('created_at', [$start, $end])->where("data_from", "BA")->sum('total_harga_everify');
            // dd($invgr);

            $year = CarbonImmutable::now()->locale('id_ID')->format('Y');
            $invthngr =Invoice::whereYear('created_at', $year)->where("data_from", "GR")->sum('total_harga_everify');
            $invthnba =Invoice::whereYear('created_at', $year)->where("data_from", "BA")->sum('total_harga_everify');

        $invoicegr = Invoice::all()->where("data_from", "GR")->Where("id_vendor", $user_vendor)->count();
        $invoiceba = Invoice::all()->where("data_from", "BA")->Where("id_vendor", $user_vendor)->count();
        $dispute = good_receipt::all()->where("status", "Disputed")->Where("vendor_name", $user_vendor2)->count();
        $notif = good_receipt::all()->where("status", "Disputed")->Where("vendor_name", $name)->whereBetween('updated_at', $range)->count();
        $vendor = User::all()->where("level", "vendor")->count();
        $draft = Draft_BA::all()->Where("id_vendor", $user_vendor)->count();
        $ba = BA_Reconcile::all()->Where("id_vendor", $user_vendor)->count();
        $month = null;
        $year = null;

        return view('admin.akreditasi',['month'=>$month, 'year'=>$year, 'good_receipt'=>$good_receipt,'draft'=>$draft, 'ba'=>$ba , 'invoicegr'=>$invoicegr, 'invoiceba'=>$invoiceba, 'dispute'=>$dispute, 'vendor'=>$vendor, 'notif'=>$notif, 'invgr'=>$invgr, 'invba'=>$invba, 'invthngr'=>$invthngr, 'invthnba'=>$invthnba]);
    }
}
