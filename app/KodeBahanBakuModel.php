<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeBahanBakuModel extends Model
{
    protected $table = 'tbl_kode_bahan_baku';//nama table
    protected $primarykey = 'id';//primary key
    protected $fillable = ['nama'];//nama kolom
    public $timestamps = false;
}
