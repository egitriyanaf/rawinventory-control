<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    protected $table = 'tbl_kategori';
    protected $primarykey = 'id';
    protected $fillable = ['kategori'];
    public $timestamps = false;
}
