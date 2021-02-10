<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    protected $table = 'tbl_supplier';//nama table
    protected $primarykey = 'id';//primary key
    protected $fillable = ['supplier', 'alamat', 'telp','email'];//nama kolom
    public $timestamps = false;
}
