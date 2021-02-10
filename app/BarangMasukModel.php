<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangMasukModel extends Model
{
    protected $table = 'tbl_barang_masuk';
    protected $primarykey = 'id';
    protected $fillable = ['id_transaksi','tanggal','id_barang','jumlah', 'tanggal_transaksi'];
    public $timestamps = false;
}
