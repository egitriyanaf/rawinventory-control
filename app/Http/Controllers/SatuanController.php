<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SatuanModel;
use DB;

class SatuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        //kelas all() berfungsi untuk mengambil semua data

		$header = 'SATUAN';//setting header
    	$breadcrumb = '<li>Master Data</li><li class="active">Satuan</li>';//setting breadcrumb
        $data = SatuanModel::all();//mengambil semua data satuan menggunakan model
        $no = 1;//setting numbering beserta data parsing
    	return view('satuan',[
    		'header' => $header,
    		'breadcrumb' => $breadcrumb,
            'data' => $data,
            'no' => $no
    	]);
    }

    //fungsi untuk menyimpan data satuan
    public function simpanSatuan(Request $r)
    {
        $tambah = new SatuanModel();//membuat object untuk menambah data baru pada table satuan dengan mengakses model
        $tambah->satuan = $r['satuan'];        
        $tambah->save();//simpan data

        return back()->with('berhasil','Tambah data berhasil!');//kembali ke halaman sebelumnya   
    }

    //fungsi untuk menyimpan perubahan data satuan
    public function ubahSatuan(Request $r, $id)//variabl $id adalah parameter
    {
        DB::table('tbl_satuan')->where('id',$id)->update([
            'satuan' => $r['satuan_edit']
        ]);

        return back()->with('berhasil_ubah','Ubah data satuan berhasil!');//kembail ke halaman sebelumnya
    }

    //fungsi untuk menghapus data satuan sesuai dengan parameter $id yang dikirimkan 
    public function hapusSatuan($id)
    {
        DB::table('tbl_satuan')->where('id', '=', $id)->delete();

        return back()->with('berhasil_hapus','Data satuan berhasil dihapus!');//kembali ke halaman sebelumnya
    }
}
