@extends('index')

@section('content')

<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <div class="box">
        <div class="box-body">
          <form action="{{ url('admin/laporan_bahan_baku_rusak_filter') }}" method="post">
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
        <a href="{{ url('admin/laporan_bahan_baku_rusak_pdf/'.str_replace('/','-',$periode)) }}" target="_blank" class="btn btn-default"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
      </div>
      <div class="box-body no-padding">
        <table class="table">
          <thead>
              <tr>
                <th>NO</th>
                <th>KODE BAHAN</th>
                <th>NAMA BAHAN</th>
                <th>STOK</th>
                <th>SATUAN</th>
                <th>DESKRIPSI</th>
                <th>TANGGAL</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $d)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $d->kode_bahan }}</td>
                  <td>{{ $d->nama_bahan }}</td>
                  <td>{{ $d->stok }}</td>
                  <td>{{ $d->satuan }}</td>
                  <td>{{ $d->deskripsi }}</td>
                  <td>{{ $d->tanggal }}</td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
@endif

@endsection