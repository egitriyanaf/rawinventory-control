@extends('index')

@section('content')

<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <div class="box">
        <div class="box-body">
          <form action="#" method="post">
            <div class="form-group">
              <label>Periode:</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right date-range">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-paper-plane"></i></button>
                  </span>
              </div>
            </div>          
          </form>
        </div>
      </div>
  </div>
  <div class="col-md-3"></div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <a href="" target="_blank" class="btn btn-default"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
      </div>
      <div class="box-body no-padding">
        <table class="table">
          <tr>
            <th style="width: 10px">NO</th>
            <th>KODE BAHAN</th>
            <th>NAMA BAHAN</th>
            <th>STOK</th>
            <th>SATUAN</th>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>


@endsection