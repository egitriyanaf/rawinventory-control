<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

class LaporanController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');//cek apakah user login atau belum
    }

    // fungsi untuk membuka halaman laporan stok barang - belum dipake
    public function lapStokBarang()
    {
    	$header = 'LAPORAN STOK BARANG';//setting header
    	$breadcrumb = '<li>Laporan</li><li class="active">Stok Barang</li>';//setting breadcrumb
    	
        //akses halaman laporan stok barang beserta parsing data
        return view('laporan_stok_barang',[
    		'header' => $header,
    		'breadcrumb' => $breadcrumb
    	]);
    }

    //fungsi untuk membuka halaman laporan barang masuk
    public function lapBarangMasuk()
    {
    	$header = 'LAPORAN BAHAN BAKU MASUK';//setting nama header
    	$breadcrumb = '<li>Laporan</li><li class="active">Bahan Baku Masuk</li>';//setting breadcrumb
    	$periode = date('Y/m/d').' - '.date('Y/m/d');//mengambil range tanggal sekarang secara default
        $data = array();//setting data sebagai array
        $table = false;//variable $table di setting false agar nanti table hasil filter di hide terlebih dahulu ketika buka halaman laporan pertama kali

        //akses file laporan barang masuk beserta parsing data
        return view('laporan_barang_masuk',[
    		'header' => $header,
            'data' => $data,
            'periode' => $periode,
            'table' => $table,
    		'breadcrumb' => $breadcrumb
    	]);
    }

    //fungsi untuk mengambil data laporan bahan baku masuk berdasarkan filter periode 
    public function lapBarangMasukFilter(Request $r)
    {
        $header = 'LAPORAN BAHAN MASUK';//setting nama header
        $breadcrumb = '<li>Laporan</li><li class="active">Bahan Masuk</li>';//setting breadcrumb
        $table = true;// variable $table diberikan nilai true agar dapat menampilkan table hasil filter
        
        //mengambil tanggal awal dari rang periode
        $periode_awal = str_replace("/","-",substr($r['periode'],0,10));
        $tanggal_mulai = date_format(date_create($periode_awal), 'Y-m-d');
        
        //mengambil tanggal akhir dari rang periode
        $periode_akhir = str_replace("/","-",substr($r['periode'],13,10));
        $tanggal_selesai = date_format(date_create($periode_akhir), 'Y-m-d');

        //setting periode
        $periode = substr($r['periode'],0,10). ' - ' .substr($r['periode'],13,10);    
        
        //mengambil data berdasarkan periode tanggal
        $data = DB::select("SELECT a.*, b.nama_bahan, b.kode_bahan FROM tbl_barang_masuk a LEFT JOIN tbl_bahan_baku b ON a.id_bahan= b.id where a.tanggal >= '".$tanggal_mulai."' and a.tanggal <= '".$tanggal_selesai."' ORDER BY a.tanggal DESC");
        $no = 1;//setting numbering

        //akses file laporan barang masuk beserta parsing data
        return view('laporan_barang_masuk',[
            'header' => $header,
            'data' => $data,
            'no' => $no,
            'table' => $table,
            'periode' => $periode,
            'breadcrumb' => $breadcrumb
        ]);
    }

    //fungsi untuk membuka halaman laporan barang keluar
    public function lapBarangKeluar()
    {
    	$header = 'LAPORAN BARANG KELUAR';//setting header
    	$breadcrumb = '<li>Laporan</li><li class="active">Barang Keluar</li>';//setting breadcrumb
        $periode = date('Y/m/d').' - '.date('Y/m/d');//setting periode tanggal sekarang
        $data = array();//setting variable $data sebagai array agar tidak terjadi error
        $table = false;//setting variable $table false agar nanti table harsil filter tidak muncul terlebih dahulu ketika membuka halaman pertama kali

        //akses file laporan barang keluar beserta parsing data
    	return view('laporan_barang_keluar',[
    		'header' => $header,
            'periode' => $periode,
            'data' => $data,
            'table' => $table,
    		'breadcrumb' => $breadcrumb
    	]);
    }

    //fungsi untuk download laporan bahan baku masuk
    public function lapBarangMasukPDF($periode)
    {
        //ambil tanggal awal
        $tanggal_mulai = date_format(date_create(substr($periode,0,10)), 'Y-m-d');
        //ambil tanggal akhir
        $tanggal_selesai = date_format(date_create(substr($periode,13,10)), 'Y-m-d');    
        //mengambil data laporan bahan baku masuk berdasarkan periode tanggal
        $data = DB::select("SELECT a.*, b.nama_bahan, b.kode_bahan FROM tbl_barang_masuk a LEFT JOIN tbl_bahan_baku b ON a.id_bahan= b.id where a.tanggal >= '".$tanggal_mulai."' and a.tanggal <= '".$tanggal_selesai."' ORDER BY a.tanggal DESC");
        $no = 1;//setting numbering
        $total = 0;//setting nilai default variable $total

        //akses file laporan barang masuk
        $pdf = \PDF::loadView('laporan.laporan_barang_masuk_pdf', [
            'data' => $data,
            'total' => $total,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'no' => $no
        ]);

        //berfungsi untuk download file beserta memberikan nama file 
        return $pdf->download('LAPORAN BAHAN BAKU MASUK '.$periode.'.pdf');
    }


    //fungsi untuk menampilkan data berdasarkan periode tanggal
    public function lapBarangKeluarFilter(Request $r)
    {
        $header = 'LAPORAN BAHAN KELUAR';//setting nama header
        $breadcrumb = '<li>Laporan</li><li class="active">Bahan Keluar</li>';//setting breadcrumb
        $table = true;//setting variable $table = true untuk menampilkan table hasil filter
        //mengambil tanggal awal
        $periode_awal = str_replace("/","-",substr($r['periode'],0,10));
        $tanggal_mulai = date_format(date_create($periode_awal), 'Y-m-d');
        //mengambil tanggal akhir
        $periode_akhir = str_replace("/","-",substr($r['periode'],13,10));
        $tanggal_selesai = date_format(date_create($periode_akhir), 'Y-m-d');
        
        //setting periode untuk ditampilkan kembali pada halaman laporan 
        $periode = substr($r['periode'],0,10). ' - ' .substr($r['periode'],13,10);    
        //mengambil data laporan berdasarkan periode
        $data = DB::select("SELECT a.*, b.nama_bahan, b.kode_bahan FROM tbl_barang_keluar a LEFT JOIN tbl_bahan_baku b ON a.id_bahan= b.id where a.tanggal >= '".$tanggal_mulai."' and a.tanggal <= '".$tanggal_selesai."' ORDER BY a.tanggal DESC");
        $no = 1;//setting numbering

        //akses file laporan barang keluar
        return view('laporan_barang_keluar',[
            'header' => $header,
            'data' => $data,
            'no' => $no,
            'table' => $table,
            'periode' => $periode,
            'breadcrumb' => $breadcrumb
        ]);
    }

    //fungsi untuk download laporang barang keluar
    public function lapBarangKeluarPDF($periode)
    {
        //mengambil tanggal mulai dari variable $periode
        $tanggal_mulai = date_format(date_create(substr($periode,0,10)), 'Y-m-d');
        //mengambil tanggal selesai dari variable $periode
        $tanggal_selesai = date_format(date_create(substr($periode,13,10)), 'Y-m-d');    
        //mengambil data laporan berdasarkan periode tanggal
        $data = DB::select("SELECT a.*, b.nama_bahan, b.kode_bahan FROM tbl_barang_keluar a LEFT JOIN tbl_bahan_baku b ON a.id_bahan= b.id where a.tanggal >= '".$tanggal_mulai."' and a.tanggal <= '".$tanggal_selesai."' ORDER BY a.tanggal DESC");
        $no = 1;//setting numbering
        $total = 0;//setting nilai default variable $table = 0

        //akses file template laporan beserta parsing data
        $pdf = \PDF::loadView('laporan.laporan_barang_keluar_pdf', [
            'data' => $data,
            'total' => $total,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'no' => $no
        ]);

        //berfungsi untuk download file beserta memberikan nama file pada laporan tersebut
        return $pdf->download('LAPORAN BAHAN BAKU KELUAR '.$periode.'.pdf');
    }

     //fungsi untuk membuka halaman laporan barang ruska
    public function lapBarangRusak()
    {
        $header = 'LAPORAN BAHAN BAKU RUSAK';//setting nama header
        $breadcrumb = '<li>Laporan</li><li class="active">Bahan Baku Rusak</li>';//setting breadcrumb
        $periode = date('Y/m/d').' - '.date('Y/m/d');//mengambil range tanggal sekarang secara default
        $data = array();//setting data sebagai array
        $table = false;//variable $table di setting false agar nanti table hasil filter di hide terlebih dahulu ketika buka halaman laporan pertama kali

        //akses file laporan barang masuk beserta parsing data
        return view('laporan_barang_rusak',[
            'header' => $header,
            'data' => $data,
            'periode' => $periode,
            'table' => $table,
            'breadcrumb' => $breadcrumb
        ]);
    }

    //fungsi untuk mengambil data laporan bahan baku rusak berdasarkan filter periode 
    public function lapBarangRusakFilter(Request $r)
    {
        $header = 'LAPORAN BAHAN BAKU RUSAK';//setting nama header
        $breadcrumb = '<li>Laporan</li><li class="active">Bahan Baku Rusak</li>';//setting breadcrumb
        $table = true;// variable $table diberikan nilai true agar dapat menampilkan table hasil filter
        
        //mengambil tanggal awal dari rang periode
        $periode_awal = str_replace("/","-",substr($r['periode'],0,10));
        $tanggal_mulai = date_format(date_create($periode_awal), 'Y-m-d');
        
        //mengambil tanggal akhir dari rang periode
        $periode_akhir = str_replace("/","-",substr($r['periode'],13,10));
        $tanggal_selesai = date_format(date_create($periode_akhir), 'Y-m-d');

        //setting periode
        $periode = substr($r['periode'],0,10). ' - ' .substr($r['periode'],13,10);    
        
        //mengambil data berdasarkan periode tanggal
        $data = DB::select("SELECT * FROM tbl_bahan_baku_rusak where tanggal >= '".$tanggal_mulai."' and tanggal <= '".$tanggal_selesai."' ORDER BY tanggal DESC");
        $no = 1;//setting numbering

        //akses file laporan barang masuk beserta parsing data
        return view('laporan_barang_rusak',[
            'header' => $header,
            'data' => $data,
            'no' => $no,
            'table' => $table,
            'periode' => $periode,
            'breadcrumb' => $breadcrumb
        ]);
    }

    //fungsi untuk download laporan bahan baku rusak
    public function lapBarangRusakPDF($periode)
    {
        //ambil tanggal awal
        $tanggal_mulai = date_format(date_create(substr($periode,0,10)), 'Y-m-d');
        //ambil tanggal akhir
        $tanggal_selesai = date_format(date_create(substr($periode,13,10)), 'Y-m-d');    
        //mengambil data laporan bahan baku masuk berdasarkan periode tanggal
        $data = DB::select("SELECT * FROM tbl_bahan_baku_rusak where tanggal >= '".$tanggal_mulai."' and tanggal <= '".$tanggal_selesai."' ORDER BY tanggal DESC");
        $no = 1;//setting numbering
        $total = 0;//setting nilai default variable $total

        //akses file laporan barang rusak
        $pdf = \PDF::loadView('laporan.laporan_barang_rusak_pdf', [
            'data' => $data,
            'total' => $total,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'no' => $no
        ]);

        //berfungsi untuk download file beserta memberikan nama file 
        return $pdf->download('LAPORAN BAHAN BAKU RUSAK '.$periode.'.pdf');
    }

    //fungsi untuk download laporan stok bahan baku
    public function lapStokBahanBakuPDF()
    {

        $data = DB::select("SELECT * FROM tbl_bahan_baku ORDER BY id DESC");
        $no = 1;//setting numbering
        $total = 0;//setting nilai default variable $total

        //akses file laporan barang rusak
        $pdf = \PDF::loadView('laporan.laporan_stok_bahan_baku_pdf', [
            'data' => $data,
            'total' => $total,
            'no' => $no
        ]);

        //berfungsi untuk download file beserta memberikan nama file 
        return $pdf->download('LAPORAN STOK BAHAN BAKU '.date('d/m/Y').'.pdf');
    }
}
