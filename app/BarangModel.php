<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    protected $table = 'tbl_barang';
    protected $primarykey = 'kode';
    protected $fillable = ['nama', 'jenis', 'stok', 'satuan'];
    public $timestamps = false;
    public $incrementing = false;
}
