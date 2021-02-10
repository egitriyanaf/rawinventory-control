<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//untuk menggunakan model pertama harus panggil model-model apa saja yang akan digunakan
use App\BarangMasukModel;
use App\BarangModel;
use App\BahanBakuModel;
//akhir bari pemanggilan model yang dibutuhkan 
use DB;//memanggil kelas DB;

class BarangMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');//berfungsi untuk mengecek apakah user sudah login atau belum, jika belum login maka sistem akan secara otomatis mengarahkan ke form login
        date_default_timezone_set('Asia/Jakarta');//setting zona waktu
    }

    public function index()
    {
    	$header = 'BARANG MASUK';//setting nama header
    	$breadcrumb = '<li>Transaksi</li><li class="active">Barang Masuk</li>';//setting breadcrumb
        
        //query untuk memperoleh data bahan masuk sesuai kebutuhan
        $data = DB::select("SELECT a.*, b.nama_bahan, b.kode_bahan FROM tbl_barang_masuk a LEFT JOIN tbl_bahan_baku b ON a.id_bahan= b.id ORDER BY a.id DESC");
        $no = 1;//setting numbering
        $bahan = BahanBakuModel::all();//mengambil data bahan baku
        $date = date('Y-m-d h:i:s');//mengambil waktu sekarang

        //cara membuat ID Transaksi otomatis
        $getId = collect(\DB::select("select * from tbl_barang_masuk order by id_transaksi desc limit 1"))->first();//query untuk mengambil ID Transaksi terakhir

        if (!empty($getId)) {//cek apakah data id kosong atau tidak
        	$num = (int) substr($getId->id_transaksi,3);//convert string ke interger
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
        //baris terakhir - cara membuat ID Transaksi otomatis

        //akses halaman barang masuk beserta parsing data
        return view('barang_masuk',[
    		'header' => $header,
    		'breadcrumb' => $breadcrumb,
            'data' => $data,
            'no' => $no,
            'date' => $date,
            'idTransaksi' => $idTransaksi,
            'bahan' => $bahan
    	]);
    }

    //fungsi untuk menyimpan transaksi barang masuk
    public function simpanBarangMasuk(Request $r)
    {

        //langkah untuk menyimpan transaksi baik 1 atau lebih dari 1 item, setiap satu kali transaksi
        for ($i=0; $i <count($r['nama_bahan']) ; $i++) {//perulangan akan mengulang sebanyak item yang diinput per transaksi
            $tambah = new BarangMasukModel(); //membuat objek untuk mengambil kolom yang dibutuhkan pada table brang masuk
            $tambah->id_transaksi = $r['id_transaksi'];        
            $tambah->tanggal = date_format(date_create($r['tanggal_masuk'][$i]),'Y-m-d');        
            $tambah->tanggal_transaksi = date("Y-m-d h:i:s");        
            $tambah->id_bahan = $r['nama_bahan'][$i];        
            $tambah->jumlah = $r['jumlah'][$i];        
            $tambah->save();//simpan barang masuk
    
            //ketika barang masuk secara otomatis stok yang ada pada gudang akan ikut bertambah
            $getBahan = collect(\DB::select("select * from tbl_bahan_baku where id = '".$r['nama_bahan'][$i]."'"))->first();//mengambil data bahan

            DB::table('tbl_bahan_baku')->where('id',$r['nama_bahan'][$i])->update([
                'stok' => ($getBahan->stok + $r['jumlah'][$i])
            ]);//mengubah data stok bahan baku yang ada pada gudang
            //baris akhir ketika barang masuk secara otomatis stok yang ada pada gudang akan ikut bertambah
        }

        return back()->with('berhasil','Tambah data berhasil!');//kembali ke halaman sebelumnya   
    }

    //fungsi untuk mengubah data barang masuk
    public function ubahBarangMasuk(Request $r, $id)
    {
        DB::table('tbl_barang_masuk')->where('id',$id)->update([
            'tanggal' => $r['tanggal_edit'],
            'jumlah' => $r['jumlah_edit']
        ]);//menyimpan perubahan pada data bahan baku masuk

        //ubah stok barang ketika data ikut dirubah
        $getBahan = collect(\DB::select("select * from tbl_bahan_baku where id = '".$r['id_nama_bahan_edit']."'"))->first();//mengambil data barang yang ingin dirubah

        DB::table('tbl_bahan_baku')->where('id',$r['id_nama_bahan_edit'])->update([
            'stok' => (($getBahan->stok - $r['jumlah_edit_old']) + $r['jumlah_edit'])
        ]);//simpan perubahan pada tabel master bahan baku

        return back()->with('berhasil_ubah','Ubah data barang masuk berhasil!');//kembali ke halaman sebelumnya
    }

    //fungsi untuk menghapus data transaksi masuk jika diperlukan
    public function hapusBarangMasuk($id)
    {
        $data = collect(\DB::select("select * from tbl_barang_masuk where id = '".$id."'"))->first();
        $getBahan = collect(\DB::select("select * from tbl_bahan_baku where id = '".$data->id_bahan."'"))->first();
        DB::table('tbl_bahan_baku')->where('id',$data->id_bahan)->update([
            'stok' => ($getBahan->stok - $data->jumlah)
        ]);        

        DB::table('tbl_barang_masuk')->where('id', '=', $id)->delete();//hapus data bahan mausk berdsarkan ID

        return back()->with('berhasil_hapus','Data barang masuk berhasil dihapus!');//kembali ke halaman sebelumnya
    }

    //fungsi untuk membuka halaman tambah barang masuk
    public function tambahBarangMasuk()
    {
        //kelas all() berfungsi untuk mengambil semua data pada table bahan baku tanpa terkecuali
        $getBahan = BahanBakuModel::all();//ambil semua data bahan baku
        $header = 'TAMBAH BAHAN BAKU';//setting header
        $breadcrumb = '<li>Transaksi</li><li>Bahan Masuk</li><li class="active">Tambah Bahan Masuk</li>';//setting breadcrumb
        
        //cara membuat ID otomatis
        $getId = collect(\DB::select("select * from tbl_barang_masuk order by id_transaksi desc limit 1"))->first();//mengambil ID Transaksi yang terakhir

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

        //baris terakhir untuk membuat ID otomatis

        //akses view tambah barang masuk beserta parsing data
        return view('tambah_barang_masuk',[
            'header' => $header,
            'getBahan' => $getBahan,
            'idTransaksi' => $idTransaksi,
            'breadcrumb' => $breadcrumb
        ]);
    }
}
