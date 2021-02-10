@extends('index')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box">
        <div class="box-header">
          <!-- <h3 class="box-title">Data Satuan</h3> -->
          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#tambah-satuan"><i class="fa fa-plus"></i> Tambah Satuan</button><!-- menampilkan modal tambah satuan -->
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="15px">NO</th>
                <th>Satuan</th>
                <th width="70px">AKSI</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $d)<!-- menampilkan data satuan -->
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $d->satuan }}</td>
                  <td>
                    <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit-satuan{{ $d->id }}"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-default btn-sm" onclick="return del('{{ $d->id }}')"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>

                <div class="modal fade" id="edit-satuan{{ $d->id }}"><!-- modal edit data satuan -->
                  <div class="modal-dialog">
                    <form action="{{ url('admin/ubah_satuan',$d->id) }}" method="post"><!-- URL untuk menyimpan perubahan data satuan -->
                      @csrf
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Edit Satuan</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="satuan_edit">Satuan</label>
                            <input type="text" class="form-control" id="satuan_edit" name="satuan_edit" value="{{ $d->satuan }}" required>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
  </div>
</div>


<div class="modal fade" id="tambah-satuan"><!-- MODAL tambah satuan -->
  <div class="modal-dialog">
    <form action="{{ url('admin/simpan_satuan') }}" method="post"><!-- URL untuk menyimpan data satuan -->
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah satuan</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="satuan">satuan</label>
            <input type="text" class="form-control" id="satuan" name="satuan" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready(function () {
  <?php 
      if (Session::get('berhasil')) {
        ?>
            Swal.fire({
              icon: 'success',
              title: 'Data satuan berhasil disimpan!',
              showConfirmButton: false,
              timer: 2000
            })
    <?php
      }else if(Session::get('berhasil_ubah')){
        ?>
            Swal.fire({
              icon: 'success',
              title: 'Data satuan berhasil diubah!',
              showConfirmButton: false,
              timer: 2000
            })
        <?php
      }else if(Session::get('berhasil_hapus')){
    ?>
          Swal.fire({
              icon: 'success',
              title: 'Data satuan berhasil dihapus!',
              showConfirmButton: false,
              timer: 2000
            })
    <?php

      }
   ?>
 });

</script>

<script type="text/javascript">
  function del(id) {
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Data yang telah dihapus tidak dapat dikembalikan lagi!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.value) {
        // URL untuk menghapus data satuan
        window.location.href = "{{ url('admin/hapus_satuan') }}"+'/'+id;
      }
    })
  }
</script>

@endsection