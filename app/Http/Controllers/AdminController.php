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

        return view('admin.dashboard');
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

        return view('admin.pmdk');
    }

    public function usm1()
    {
     
        return view('admin.usm1');
    }

    public function usm2()
    {
     
        return view('admin.usm2');
    }

    public function usm3()
    {
      
        return view('admin.usm3');
    }

    public function utbk()
    {
     
        return view('admin.utbk');
    }

    public function prodi()
    {
     
        return view('admin.prodi');
    }

    public function asal()
    {
       
        return view('admin.asal');
    }

    public function akreditasi()
    {
    
        return view('admin.akreditasi');
    }
}
