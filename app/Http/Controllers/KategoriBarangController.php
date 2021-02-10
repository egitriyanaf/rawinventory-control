<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriModel;
use DB;

class KategoriBarangController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	$header = 'KATEGORI';
    	$breadcrumb = '<li>Master Data</li><li class="active">Kategori</li>';
        $data = KategoriModel::all();
        $no = 1;
    	return view('kategori_kategori',[
    		'header' => $header,
    		'breadcrumb' => $breadcrumb,
            'data' => $data,
            'no' => $no
    	]);
    }

    public function simpanKategori(Request $r)
    {
        $tambah = new KategoriModel();
        $tambah->kategori = $r['kategori'];        
        $tambah->save();

        return back()->with('berhasil','Tambah data berhasil!');   
    }

    public function ubahKategori(Request $r, $id)
    {
        DB::table('tbl_kategori')->where('id',$id)->update([
            'kategori' => $r['kategori_edit']
        ]);

        return back()->with('berhasil_ubah','Ubah data kategori berhasil!');
    }

    public function hapusKategori($id)
    {
        DB::table('tbl_kategori')->where('id', '=', $id)->delete();

        return back()->with('berhasil_hapus','Data kategori berhasil dihapus!');
    }
}
