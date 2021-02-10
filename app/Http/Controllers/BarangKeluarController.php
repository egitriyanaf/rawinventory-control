<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BarangKeluarModel;
use App\BahanBakuModel;
use DB;

class BarangKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');//berfungsi untuk mengecek user login atau belum
        date_default_timezone_set('Asia/Jakarta');//setting zona waktu
    }

    //fungsi untuk menampilkan halaman semua transaksi barang keluar
    public function index()
    {

        //kelas all() berfungsi mengambil semua data pada table tanpa terkecuali
        // $data = BarangKeluarModel::all();//mengambil semua data barang keluar
    	$data = DB::select("SELECT a.*, b.nama_bahan, b.kode_bahan FROM tbl_barang_keluar a LEFT JOIN tbl_bahan_baku b ON a.id_bahan = b.id ORDER BY a.tanggal_transaksi desc");
    	$header = 'BARANG KELUAR';//setting header
    	$breadcrumb = '<li>Transaksi</li><li class="active">Barang Keluar</li>';//setting breadcrumb

        $no = 1;//setting numbering
        $bahan = BahanBakuModel::all();//mengambil semua data bahan baku
        $date = date('Y-m-d h:i:s');//mengambil waktu sekarang

        //akses view barang keluar beserta parsing data
    	return view('barang_keluar',[
    		'header' => $header,
            'data' => $data,
            'no' => $no,
            'bahan' => $bahan,
            'date' => $date,
    		'breadcrumb' => $breadcrumb
    	]);
    }

    //fungsi untuk menampilkan halaman tambah barang keluar
    public function tambahBarangKeluar()
    {
        $getBahan = BahanBakuModel::all();//mengambil semua data bahan baku
        $header = 'TAMBAH BAHAN BAKU KELUAR';//setting header
        $breadcrumb = '<li>Transaksi</li><li>Bahan Keluar</li><li class="active">Tambah Bahan Keluar</li>';//setting breadcrumb
        
        //cara membuat ID TRANSAKSI Otomatis
        $getId = collect(\DB::select("select * from tbl_barang_keluar order by id_transaksi desc limit 1"))->first();

        if (!empty($getId)) {
            $num = (int) substr($getId->id_transaksi,3);
            if ($num < 9) {
                $idTransaksi = 'TR-0000'.($num + 1);
            }else if ($num < 99) {
                $idTransaksi = 'TR-000'.($num + 1);
            }else if ($num < 999) {
                $idTransaksi = 'TR-00'.($num + 1);
            }else if ($num < 9999) {
                $idTransaksi = 'TR-0'.($num + 1);
            }else if ($num < 99999) {
                $idTransaksi = 'TR-'.($num + 1);
            }
        }else{
            $idTransaksi = 'TR-00001';
        }

        //baris terakhir untuk membuat ID TRANSAKSI Otomatis

        //akses view tambah barang keluar beserta parsing data
        return view('tambah_barang_keluar',[
            'header' => $header,
            'getBahan' => $getBahan,
            'idTransaksi' => $idTransaksi,
            'breadcrumb' => $breadcrumb
        ]);
    }

    //fungsi untuk menyimpan data transaksi barang atau bahan baku keluar
    public function simpanBarangKeluar(Request $r)
    {

        for ($i=0; $i <count($r['nama_bahan']) ; $i++) {//looping ini berfungsi untuk menyimpan secara bertahap semua data transaksi, baik datanya 1 atau lebih dari 1 item
            $tambah = new BarangKeluarModel();//membuat objek barang keluar
            $tambah->id_transaksi = $r['id_transaksi'];        
            $tambah->tanggal = date_format(date_create($r['tanggal_masuk'][$i]),'Y-m-d');        
            $tambah->tanggal_transaksi = date("Y-m-d h:i:s");        
            $tambah->id_bahan = $r['nama_bahan'][$i];        
            $tambah->jumlah = $r['jumlah'][$i];        
            $tambah->save();//simpan data
    
            //setiap kali ada transaksi keluar maka secara otomatis data stok yang ada digudang akan ikut berubah dan berkurang
            $getBahan = collect(\DB::select("select * from tbl_bahan_baku where id = '".$r['nama_bahan'][$i]."'"))->first();//mengambil data bahan baku yang ingin diupdate data stoknya berdasarkan nama bahan baku yang diinput
            DB::table('tbl_bahan_baku')->where('id',$r['nama_bahan'][$i])->update([
                'stok' => ($getBahan->stok - $r['jumlah'][$i])
            ]);//ubah data stok bahan baku
        }

        return back()->with('berhasil','Tambah data berhasil!');//kembali ke halaman sebelumnya   
    }

    public function hapusBarangKeluar($id)
    {
        $data = collect(\DB::select("select * from tbl_barang_keluar where id = '".$id."'"))->first();
        $dataBK = collect(\DB::select("select * from tbl_bahan_baku where id = '".$data->id_bahan."'"))->first();

        DB::table('tbl_bahan_baku')->where('id',$data->id_bahan)->update([
                'stok' => ($dataBK->stok + $data->jumlah)
            ]);

        DB::table('tbl_barang_keluar')->where('id', '=', $id)->delete();

        return back()->with('berhasil_hapus','Data barang keluar berhasil dihapus!');
    }

    public function updateBarangKeluar(Request $r, $id)
    {
        $data = collect(\DB::select("select * from tbl_barang_keluar where id = '".$id."'"))->first();
        $dataBK = collect(\DB::select("select * from tbl_bahan_baku where id = '".$data->id_bahan."'"))->first();

        DB::table('tbl_bahan_baku')->where('id',$data->id_bahan)->update([
            'stok' => ($dataBK->stok + $r['jumlah_edit_old'] - $r['jumlah_edit'])
        ]);

        DB::table('tbl_barang_keluar')->where('id',$id)->update([
            'tanggal' => $r['tanggal_edit'],
            'id_bahan' => $r['id_nama_bahan_edit'],
            'jumlah' => $r['jumlah_edit']
        ]);

        return back()->with('berhasil_ubah','Ubah data barang keluar berhasil!');
    }
}
