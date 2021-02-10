@extends('index')

@section('content')

<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <div class="box">
        <div class="box-body">
          <form action="{{ url('admin/laporan_bahan_keluar_filter') }}" method="post">
            @csrf
            <div class="form-group">
              <label>Periode:</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right date-range" id="periode" name="periode" value="{{ $periode }}" required>
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

@if($table)
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <a href="{{ url('admin/laporan_bahan_keluar_pdf/'.str_replace('/','-',$periode)) }}" target="_blank" class="btn btn-default"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
      </div>
      <div class="box-body no-padding">
        <table class="table">
          <tr>
            <th style="width: 10px">NO</th>
            <th>ID TRANSAKSI</th>
            <th>TANGGAL KELUAR</th>
            <th>KODE BAHAN</th>
            <th>NAMA BAHAN</th>
            <th>JUMLAH</th>
          </tr>
          @foreach($data as $d)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $d->id_transaksi }}</td>
              <td>{{ $d->tanggal }}</td>
              <td>{{ $d->kode_bahan }}</td>
              <td>{{ $d->nama_bahan }}</td>
              <td>{{ $d->jumlah }}</td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
@endif

@endsection