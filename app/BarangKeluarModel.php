<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangKeluarModel extends Model
{
    protected $table = 'tbl_barang_keluar';
    protected $primarykey = 'id';
    protected $fillable = ['id_transaksi','tanggal','id_barang','jumlah', 'tanggal_transaksi'];
    public $timestamps = false;
}
