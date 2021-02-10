<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BahanBakuModel;
use App\KodeBahanBakuModel;
use App\SatuanModel;
use App\BahanBakuRusak;
use App\SupplierModel;
use DB;

class BahanBakuController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // kelas all() berfungsi untuk mengambil semua data
        
    	$header = 'BAHAN BAKU';//setting header
    	$breadcrumb = '<li>Master Data</li><li class="active">Bahan Baku</li>'; // setting breadcrumb
        // $data = BahanBakuModel::all(); //akses BahanBakuModel untuk memperoleh data
        $data = DB::select("select a.*, b.supplier from tbl_bahan_baku a left join tbl_supplier b on a.id_supplier = b.id"); //query untuk mengambil data bahan baku join dengan table supplier untuk menampilkanan nama supplier
        $kodeBahanBaku = KodeBahanBakuModel::all(); //akses kodeBahanBaku untuk memperoleh data
        $satuan = SatuanModel::all(); // akses SatuanModel untuk memperoleh data
        $supplier = SupplierModel::all(); // akses SupplierModel untuk memperoleh data
        $no=1; //setting numbering

        //akses view bahan baku beserta pasing data
        return view('bahan_baku',[
    		'header' => $header,
    		'breadcrumb' => $breadcrumb,
            'data' => $data,
            'kodeBahanBaku' => $kodeBahanBaku,
            'satuan' => $satuan,
            'supplier' => $supplier,
            'no' => $no
    	]);
    }

    //fungsi untuk menyimpan bahan baku
    public function simpanBahanBaku(Request $r)
    {
        $tambah = new BahanBakuModel(); //membuat object untuk BahanBakuModel      
        $tambah->nama_bahan = $r['nama_bahan'];        
        $tambah->stok = $r['stok'];        
        $tambah->satuan = $r['satuan'];        
        $tambah->kode_bahan = $r['kode_bahan_baku'];
        $tambah->id_supplier = $r['supplier'];
        $tambah->save(); //simpan data bahan baku

        return back()->with('berhasil','Tambah data bahan baku berhasil!'); //kembali ke halaman sebelumnya   
    }

    //fungsi untuk menyimpan kode bahan
    public function simpanKodeBahan(Request $r)
    {
        $tambah = new KodeBahanBakuModel(); //membuat object untuk KodeBahanBakuModel      
        $tambah->nama = $r['kode_bahan'];        
        $tambah->save();//simpan data kode bahan

        return back()->with('berhasil','Tambah data bahan baku berhasil!'); // kembali ke halaman sebelumnya   
    }

    // fungsi untuk mengubahan data bahan baku
    public function ubahBahanBaku(Request $r, $id)
    {
        DB::table('tbl_bahan_baku')->where('id',$id)->update([
            'nama_bahan' => $r['nama_bahan_edit'],
            'stok' => $r['stok_edit'],
            'satuan' => $r['satuan_edit'],
            'kode_bahan' => $r['kode_bahan_baku_edit'],
            'id_supplier' => $r['supplier_edit']
        ]);

        return back()->with('berhasil_ubah','Ubah data bahan baku berhasil!');//kembali ke halaman sebelumnya
    }

    //fungsi untuk mengubah kode bahan baku
    public function ubahKodeBahanBaku(Request $r, $id) // variable $id adalah parameter
    {
        DB::table('tbl_kode_bahan_baku')->where('id',$id)->update([
            'nama' => $r['edit_kode_bahan']
        ]);

        return back()->with('berhasil_ubah','Ubah kode bahan baku berhasil!');//kembali ke halaman sebelumnya
    }

    //fungsi untuk menghapus data bahan baku
    public function hapusBahanBaku($id)//varibae $id adalah parameter
    {

        DB::table('tbl_bahan_baku')->where('id', '=', $id)->delete();

        return back()->with('berhasil_hapus','Data bahan baku berhasil dihapus!');//kembali ke halaman sebelumnya
    }


    //fungsi untuk menghapus kode bahan baku
    public function hapusKodeBahanBaku($id)//variable $id adalah parameter
    {

        DB::table('tbl_kode_bahan_baku')->where('id', '=', $id)->delete();

        return back()->with('berhasil_hapus','Data kode bahan baku berhasil dihapus!');//kembali ke halaman sebelumnya
    }

    //fungsi untuk menampilkan data kode bahan baku
    public function kodeBahanBaku()
    {
        $data = KodeBahanBakuModel::all();//akses KodeBahanBakuModel untuk memperoleh data 
        $no = 1;//setting numbering
        $header = 'KODE BAHAN BAKU';//setting header
        $breadcrumb = '<li>Master Data</li><li>Bahan Baku</li><li class="active">Kode Bahan Baku</li>';//setting breadcrumb

        //akses view kode bahan baku dengan parsing data
        return view('kode_bahan_baku', [
            'header' => $header,
            'breadcrumb' => $breadcrumb,
            'data' => $data,
            'no' => $no
        ]);
    }

    //bahan baku rusak

    public function bahanBakuRusak()
    {
        // kelas all() berfungsi untuk mengambil semua data
        
        $header = 'BAHAN BAKU RUSAK';//setting header
        $breadcrumb = '<li>Master Data</li><li class="active">Bahan Baku Rusak</li>'; // setting breadcrumb
        $data = BahanBakuRusak::all(); //akses BahanBakuModel untuk memperoleh data
        $namaBahan = BahanBakuModel::all(); //akses BahanBakuModel untuk memperoleh data
        $kodeBahanBaku = KodeBahanBakuModel::all(); //akses kodeBahanBaku untuk memperoleh data
        $satuan = SatuanModel::all(); // akses SatuanModel untuk memperoleh data
        $no=1; //setting numbering

        //akses view bahan baku beserta pasing data
        return view('bahan_baku_rusak',[
            'header' => $header,
            'breadcrumb' => $breadcrumb,
            'data' => $data,
            'namaBahan' => $namaBahan,
            'kodeBahanBaku' => $kodeBahanBaku,
            'satuan' => $satuan,
            'no' => $no
        ]);
    }

    //fungsi untuk menyimpan bahan baku
    public function simpanBahanBakuRusak(Request $r)
    {
        $tambah = new BahanBakuRusak(); //membuat object untuk BahanBakuModel      
        $tambah->nama_bahan = $r['nama_bahan_rusak'];        
        $tambah->stok = $r['stok'];        
        $tambah->satuan = $r['satuan'];        
        $tambah->kode_bahan = $r['kode_bahan_baku'];
        $tambah->deskripsi = $r['deskripsi'];
        $tambah->tanggal = date('Y-m-d');
        $tambah->save(); //simpan data bahan baku

        //setiap kali ada transaksi keluar maka secara otomatis data stok yang ada digudang akan ikut berubah dan berkurang
        $getBahan = collect(\DB::select("select * from tbl_bahan_baku where nama_bahan = '".$r['nama_bahan_rusak']."'"))->first();//mengambil data bahan baku yang ingin diupdate data stoknya berdasarkan nama bahan baku yang diinput
        DB::table('tbl_bahan_baku')->where('nama_bahan',$r['nama_bahan_rusak'])->update([
            'stok' => ($getBahan->stok - $r['stok'])
        ]);//ubah data stok bahan baku

        return back()->with('berhasil','Tambah data bahan baku rusak berhasil!'); //kembali ke halaman sebelumnya   
    }

    // fungsi untuk mengubahan data bahan baku
    public function ubahBahanBakuRusak(Request $r, $id)
    {
        DB::table('tbl_bahan_baku_rusak')->where('id',$id)->update([
            'nama_bahan' => $r['nama_bahan_edit'],
            'stok' => $r['stok_edit'],
            'satuan' => $r['satuan_edit'],
            'kode_bahan' => $r['kode_bahan_baku_edit'],
            'deskripsi' => $r['deskripsi_edit']
        ]);

        DB::table('tbl_bahan_baku')->where('nama_bahan',$r['nama_bahan_edit'])->update([
            'stok' => $r['sisa_stok_edit']
        ]);

        return back()->with('berhasil_ubah','Ubah data bahan baku berhasil!');//kembali ke halaman sebelumnya
    }

    //fungsi untuk menghapus data bahan baku
    public function hapusBahanBakuRusak($id)//varibae $id adalah parameter
    {
        $data = collect(\DB::select("select * from tbl_bahan_baku_rusak where id = '".$id."'"))->first();
        $dataBK = collect(\DB::select("select * from tbl_bahan_baku where nama_bahan = '".$data->nama_bahan."' and kode_bahan = '".$data->kode_bahan."'"))->first();
        
        
        DB::table('tbl_bahan_baku')->where('nama_bahan',$data->nama_bahan)->where('kode_bahan',$data->kode_bahan)->update([
            'stok' => ($data->stok + $dataBK->stok)
        ]);

        DB::table('tbl_bahan_baku_rusak')->where('id', '=', $id)->delete();

        return back()->with('berhasil_hapus','Data bahan baku berhasil dihapus!');//kembali ke halaman sebelumnya
    }
}
