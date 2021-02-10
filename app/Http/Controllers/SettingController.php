<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Auth;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function user()
    {
        $data = User::all();
    	$header = 'USER';
    	$breadcrumb = '<li class="active">User</li>';
        $no = 1;
        $password = Auth::user()->password;
        // $password = Crypt::decryptString($pass);

    	return view('user',[
    		'header' => $header,
            'data' => $data,
            'password' => $password,
            'no' => $no,
    		'breadcrumb' => $breadcrumb
    	]);
    }
     
    //  public function tambahUser()
    // {
    //     $header = 'TAMBAH USER';
    //     $breadcrumb = '<li class="active">Tambah User</li>';
    //     return view('user',[
    //         'header' => $header,
    //         'breadcrumb' => $breadcrumb
    //     ]);
    // }   

    public function hapusUser($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();

        return back()->with('berhasil_hapus','Data barang berhasil dihapus!');
    }

    public function ubahUser(Request $r, $id)
    {
        // $ubah = new BarangModel::find();
        DB::table('users')->where('id',$id)->update([
            'name' => $r['name_edit'],
            'email' => $r['email_edit'],
            'password' => Hash::make($r['password_edit'])
        ]);

        return back()->with('berhasil_ubah','Ubah data barang berhasil!');
    }

    public function dokumentasi()
    {
        $header = 'DOKUMENTASI';
        $breadcrumb = '<li class="active">Dokumentasi</li>';
        return view('dokumentasi',[
            'header' => $header,
            'breadcrumb' => $breadcrumb
        ]);
    }

    public function hakAkses()
    {
        $data = User::all();
        $header = 'HAK AKSES';
        $breadcrumb = '<li>User</li><li class="active">Hak Akses</li>';
        $no = 1;

        return view('hak_akses',[
            'header' => $header,
            'data' => $data,
            'no' => $no,
            'breadcrumb' => $breadcrumb
        ]);
    }

    public function ubahHakAkses(Request $r)
    {
        for ($i=0; $i < count($r['id']); $i++) { 
            DB::table('users')->where('id',$r['id'][$i])->update([
                'hak_bahan_baku' => (empty($r['bahan_baku'.$r['id'][$i]])) ? 0 : 1,
                'hak_supplier' => (empty($r['supplier'.$r['id'][$i]])) ? 0 : 1,
                'hak_transaksi' => (empty($r['transaksi'.$r['id'][$i]])) ? 0 : 1,
                'hak_laporan' => (empty($r['laporan'.$r['id'][$i]])) ? 0 : 1,
                'hak_user' => (empty($r['user'.$r['id'][$i]])) ? 0 : 1
            ]);
        }
        return back()->with('berhasil_ubah','Ubah hak akses berhasil!');
    }

    public function ubahPassword()
    {
        $header = 'UBAH PASSWORD';
        $breadcrumb = '<li class="active">Ubah Password</li>';
        $no = 1;
        $userEmail = Auth::user()->email;
        $getData = collect(\DB::select("select * from users where email = '".$userEmail."'"))->first();

        return view('ubah_password',[
            'header' => $header,
            'getData' => $getData,
            'no' => $no,
            'breadcrumb' => $breadcrumb
        ]);   
    }

    public function simpanUbahPassword(Request $r, $email)
    {

        $getData = collect(\DB::select("select * from users where email = '".$email."'"))->first();
        $pw = $r['password_lama'];
        $newPass = Hash::make($r['password_baru']);
        $check = Hash::check($pw, $getData->password);
        // echo $check;
        // exit;

        if ($check == 1) {
            DB::table('users')->where('email',$email)->update([
                'password' => $newPass
            ]);

            return back()->with('berhasil_ubah','Ubah data barang berhasil!');
        }else{
            return back()->with('gagal','Password lama tidak sesuai!');
        }

    }
}
