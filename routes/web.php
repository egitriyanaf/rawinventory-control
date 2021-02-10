<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('admin/dashboard');;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {
	
	Route::get('dashboard', 'DashboardController@index');
	
	//MASTER DATA
	Route::get('barang', 'BarangController@index');
	Route::post('simpan_barang', 'BarangController@simpanBarang');
	Route::post('ubah_barang/{kode}', 'BarangController@ubahBarang');
	Route::get('hapus_barang/{kode}', 'BarangController@hapusBarang');

	Route::get('bahan_baku', 'BahanBakuController@index');
	Route::post('simpan_bahan_baku', 'BahanBakuController@simpanBahanBaku');
	Route::post('ubah_bahan_baku/{id}', 'BahanBakuController@ubahBahanBaku');
	Route::get('hapus_bahan_baku/{id}', 'BahanBakuController@hapusBahanBaku');
	Route::get('laporan_stok_bahan_baku_pdf', 'LaporanController@lapStokBahanBakuPDF');


	//DATA SUPPLIER
	Route::get('supplier', 'SupplierController@index');
	Route::post('simpan_supplier', 'SupplierController@simpanSupplier');
	Route::post('ubah_supplier/{id}', 'SupplierController@ubahSupplier');
	Route::get('hapus_supplier/{id}', 'SupplierController@hapusSupplier');


	//bahan baku rusak
	Route::get('bahan_baku_rusak', 'BahanBakuController@bahanBakuRusak');
	Route::post('simpan_bahan_baku_rusak', 'BahanBakuController@simpanBahanBakuRusak');
	Route::post('ubah_bahan_baku_rusak/{id}', 'BahanBakuController@ubahBahanBakuRusak');
	Route::get('hapus_bahan_baku_rusak/{id}', 'BahanBakuController@hapusBahanBakuRusak');
	//end of bahan baku rusak
	Route::get('kode_bahan_baku', 'BahanBakuController@kodeBahanBaku');
	Route::post('simpan_kode_bahan', 'BahanBakuController@simpanKodeBahan');
	Route::post('ubah_kode_bahan_baku/{id}', 'BahanBakuController@ubahKodeBahanBaku');
	Route::get('hapus_kode_bahan_baku/{id}', 'BahanBakuController@hapusKodeBahanBaku');

	Route::get('kategori', 'KategoriBarangController@index');
	Route::post('simpan_kategori', 'KategoriBarangController@simpanKategori');
	Route::post('ubah_kategori/{id}', 'KategoriBarangController@ubahKategori');
	Route::get('hapus_kategori/{id}', 'KategoriBarangController@hapusKategori');

	Route::get('satuan', 'SatuanController@index');
	Route::post('simpan_satuan', 'SatuanController@simpanSatuan');
	Route::post('ubah_satuan/{id}', 'SatuanController@ubahSatuan');
	Route::get('hapus_satuan/{id}', 'SatuanController@hapusSatuan');
	
	// TRANSAKSI
	Route::get('barang_masuk', 'BarangMasukController@index');
	Route::get('tambah_barang_masuk', 'BarangMasukController@tambahBarangMasuk');
	Route::post('simpan_barang_masuk', 'BarangMasukController@simpanBarangMasuk');//revisi
	Route::post('ubah_barang_masuk/{id}', 'BarangMasukController@ubahBarangMasuk');
	Route::get('hapus_barang_masuk/{id}', 'BarangMasukController@hapusBarangMasuk');
	
	Route::post('simpan_transaksi_bahan_baku', 'BarangMasukController@simpanBarangMasuk');

	Route::get('barang_keluar', 'BarangKeluarController@index');
	Route::get('tambah_barang_keluar', 'BarangKeluarController@tambahBarangKeluar');
	Route::post('simpan_transaksi_bahan_baku_keluar', 'BarangKeluarController@simpanBarangKeluar');
	Route::get('hapus_barang_keluar/{id}', 'BarangKeluarController@hapusBarangKeluar');
	Route::post('ubah_barang_keluar/{id}', 'BarangKeluarController@updateBarangKeluar');

	//LAPORAN
	Route::get('laporan_stok_barang', 'LaporanController@lapStokBarang');
	Route::get('laporan_bahan_baku_masuk', 'LaporanController@lapBarangMasuk');
	Route::post('laporan_bahan_masuk_filter', 'LaporanController@lapBarangMasukFilter');
	Route::get('laporan_bahan_masuk_pdf/{periode}', 'LaporanController@lapBarangMasukPDF');
	Route::get('laporan_bahan_baku_keluar', 'LaporanController@lapBarangKeluar');
	Route::post('laporan_bahan_keluar_filter', 'LaporanController@lapBarangKeluarFilter');
	Route::get('laporan_bahan_keluar_pdf/{periode}', 'LaporanController@lapBarangKeluarPDF');

	//LAPORAN BAHAN BAKU RUSAK
	Route::get('laporan_bahan_baku_rusak', 'LaporanController@lapBarangRusak');
	Route::post('laporan_bahan_baku_rusak_filter', 'LaporanController@lapBarangRusakFilter');
	Route::get('laporan_bahan_baku_rusak_pdf/{periode}', 'LaporanController@lapBarangRusakPDF');
	
	//PENGATURAN
	Route::get('user', 'SettingController@user');
	// Route::get('tambah_user', 'SettingController@tambahUser');
	Route::get('hapus_user/{id}', 'SettingController@hapusUser');
	Route::post('ubah_user/{id}', 'SettingController@ubahUser');
	Route::get('dokumentasi', 'SettingController@dokumentasi');
	
	Route::get('hak_akses', 'SettingController@hakAkses');
	Route::post('update_hak_akses', 'SettingController@ubahHakAkses');
	
	Route::get('ubah_password', 'SettingController@ubahPassword');
	Route::post('simpan_ubah_password/{email}', 'SettingController@simpanUbahPassword');
});
