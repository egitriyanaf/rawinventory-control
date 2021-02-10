<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$header = 'HOME';//setting nama header
    	$breadcrumb = '';//setting breadcrumb

        //ambil total bahan baku
        $bahanBaku = collect(\DB::select("SELECT SUM(stok) AS jml FROM tbl_bahan_baku"))->first();
        
        //ambil total bahan baku masuk
        $bahanBakuMasuk = collect(\DB::select("SELECT SUM(jumlah) AS jml FROM tbl_barang_masuk"))->first();
        
        //ambil total bahan baku keluar
        $bahanBakuKeluar = collect(\DB::select("SELECT SUM(jumlah) AS jml FROM tbl_barang_keluar"))->first();

        //ambil data total user
        $users = collect(\DB::select("SELECT count(*) AS jml FROM users"))->first();

        //akses view dashboard serta parsing data
    	return view('dashboard',[
    		'header' => $header,
            'bahanBaku' => $bahanBaku,
            'bahanBakuMasuk' => $bahanBakuMasuk,
            'bahanBakuKeluar' => $bahanBakuKeluar,
            'users' => $users,
    		'breadcrumb' => $breadcrumb
    	]);
    }
}
