<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SupplierModel;
use DB;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // kelas all() berfungsi untuk mengambil semua data
        
    	$header = 'SUPPLIER';//setting header
    	$breadcrumb = '<li class="active">Supplier</li>'; // setting breadcrumb
        $data = SupplierModel::all(); //akses SupplierModel untuk memperoleh data
        $no=1; //setting numbering

        //akses view supplier beserta pasing data
        return view('supplier',[
    		'header' => $header,
    		'breadcrumb' => $breadcrumb,
            'data' => $data,
            'no' => $no
    	]);
    }

    //fungsi untuk menyimpan data supplier
    public function simpanSupplier(Request $r)
    {
        $tambah = new SupplierModel(); //membuat object untuk SupplierModel      
        $tambah->supplier = $r['supplier'];        
        $tambah->alamat = $r['alamat'];        
        $tambah->telp = $r['telp'];        
        $tambah->email = $r['email'];        
        $tambah->save(); //simpan data supplier

        return back()->with('berhasil','Tambah data supplier berhasil!'); //kembali ke halaman sebelumnya   
    }

    // fungsi untuk mengubahan data supplier
    public function ubahSupplier(Request $r, $id)
    {
        DB::table('tbl_supplier')->where('id',$id)->update([
            'supplier' => $r['supplier_edit'],
            'alamat' => $r['alamat_edit'],
            'telp' => $r['telp_edit'],
            'email' => $r['email_edit']
        ]);

        return back()->with('berhasil_ubah','Ubah data supplier berhasil!');//kembali ke halaman sebelumnya
    }

    //fungsi untuk menghapus data supplier
    public function hapusSupplier($id)//varibae $id adalah parameter
    {

        DB::table('tbl_supplier')->where('id', '=', $id)->delete();

        return back()->with('berhasil_hapus','Data supplier berhasil dihapus!');//kembali ke halaman sebelumnya
    }
}
