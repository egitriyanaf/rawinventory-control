<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BahanBakuRusak extends Model
{
    protected $table = 'tbl_bahan_baku_rusak';//nama table
    protected $primarykey = 'id';//primary key
    protected $fillable = ['nama_bahan', 'satuan', 'stok', 'kode_bahan', 'deskripsi','tanggal'];//nama kolom
    public $timestamps = false;
}
