<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Sales;
use App\Model\M_supplier;
use App\Model\M_produk;
use App\Model\Purchase_order;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = 'Beranda Admin';
        $tot_pendapatan = Sales::whereDate('created_at',date('Y-m-d'))->sum('grand_total');
        $tot_supplier = M_supplier::count();
        $tot_produk = M_produk::count();
        $tot_po = Purchase_order::count();

        return view('home',compact('title','tot_pendapatan','tot_supplier','tot_produk','tot_po'));
    }
}
