@extends('index')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box">
      <form action="{{ url('admin/update_hak_akses') }}" method="POST">
        @csrf
        <div class="box-header">
          <!--  -->
          <a href="{{ url('admin/user') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
          <button type="submit" class="btn btn-default"><i class="fa fa-save"></i> Simpan Perubahan</button>
        </div>
        <div class="box-body no-padding">
          <table class="table">
            <tr>
              <th></th>
              <th style="width: 10px">NO</th>
              <th>NAMA</th>
              <th>BAHAN BAKU</th>
              <th>SUPPLIER</th>
              <th>TRANSAKSI</th>
              <th>LAPORAN</th>
              <th>USER</th>
            </tr>
            @foreach($data as $d)
              <input type="hidden" name="id[]" value="{{ $d->id}}">
              <tr>
                <td>
                  
                </td>
                <td>{{ $no++ }}</td>
                <td>{{ $d->name }}</td>
                <td>
                  <div class="form-group">
                    <label>
                      <input type="checkbox" class="minimal" id="bahan_baku" name="bahan_baku{{ $d->id }}" value="1" <?= $d->hak_bahan_baku == 1 ? 'checked' : ''; ?> >
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <label>
                      <input type="checkbox" class="minimal" id="supplier" name="supplier{{ $d->id }}" value="1" <?= $d->hak_supplier == 1 ? 'checked' : ''; ?>>
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <label>
                      <input type="checkbox" class="minimal" id="transaksi" name="transaksi{{ $d->id }}" value="1" <?= $d->hak_transaksi == 1 ? 'checked' : ''; ?>>
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <label>
                      <input type="checkbox" class="minimal" id="laporan" name="laporan{{ $d->id }}" value="1" <?= $d->hak_laporan == 1 ? 'checked' : ''; ?>>
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <label>
                      <input type="checkbox" class="minimal" id="user" name="user{{ $d->id }}" value="1" <?= $d->hak_user == 1 ? 'checked' : ''; ?>>
                    </label>
                  </div>
                </td>
              </tr>
            @endforeach
          </table>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready(function () {

    <?php
      if(Session::get('berhasil_ubah')){
        ?>
            Swal.fire({
              icon: 'success',
              title: 'Hak akses user berhasil disimpan!',
              showConfirmButton: false,
              timer: 2000
            })
        <?php
      }
    ?>
 });

</script>
@endsection