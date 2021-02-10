<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SatuanModel extends Model
{
    protected $table = 'tbl_satuan';//nama table
    protected $primarykey = 'id';//primary key
    protected $fillable = ['satuan'];//nama kolom
    public $timestamps = false;
}
