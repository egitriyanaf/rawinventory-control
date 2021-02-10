<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BahanBakuModel extends Model
{
    protected $table = 'tbl_bahan_baku';//nama table
    protected $primarykey = 'id';//primary key
    protected $fillable = ['nama_bahan', 'satuan', 'stok', 'kode_bahan'];//nama kolom
    public $timestamps = false;
}
