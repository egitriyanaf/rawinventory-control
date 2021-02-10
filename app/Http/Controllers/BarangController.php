<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BarangModel;
use App\KategoriModel;
use App\SatuanModel;
use DB;

class BarangController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$header = 'DATA BARANG';
    	$breadcrumb = '<li>Master Data</li><li class="active">Data Barang</li>';
        $data = BarangModel::all();
    	$no = 1;
        $kategori = KategoriModel::all();
        $satuan = SatuanModel::all();

        $getId = collect(\DB::select("select * from tbl_barang order by kode desc limit 1"))->first();

        if (!empty($getId)) {
            $num = (int) substr($getId->kode,1);
            if ($num < 9) {
                $kode = 'B000'.($num + 1);
            }else if ($num < 99) {
                $kode = 'B00'.($num + 1);
            }else if ($num < 999) {
                $kode = 'B0'.($num + 1);
            }else if ($num < 9999) {
                $kode = 'B'.($num + 1);
            }
        }else{
            $kode = 'B0001';
        }

        return view('barang',[
    		'header' => $header,
    		'breadcrumb' => $breadcrumb,
            'data' => $data,
            'kode' => $kode,
            'kategori' => $kategori,
            'satuan' => $satuan,
            'no' => $no
    	]);
    }

    public function simpanBarang(Request $r)
    {
        $tambah = new BarangModel();
        $tambah->kode = $r['id_barang'];        
        $tambah->nama = $r['nama_barang'];        
        $tambah->kategori = $r['kategori'];        
        $tambah->satuan = $r['satuan'];        
        $tambah->stok = $r['stok'];
        $tambah->save();

        return back()->with('berhasil','Tambah data berhasil!');   
    }

    public function ubahBarang(Request $r, $kode)
    {
        // $ubah = new BarangModel::find();
        DB::table('tbl_barang')->where('kode',$kode)->update([
            'nama' => $r['nama_barang_edit'],
            'kategori' => $r['kategori_edit'],
            'stok' => $r['stok_edit'],
            'satuan' => $r['satuan_edit']
        ]);

        return back()->with('berhasil_ubah','Ubah data barang berhasil!');
    }

    public function hapusBarang($kode)
    {
        // $hapus = BarangModel::findOrFail($kode);
        // $hapus->delete();

        DB::table('tbl_barang')->where('kode', '=', $kode)->delete();

        return back()->with('berhasil_hapus','Data barang berhasil dihapus!');
    }
}
