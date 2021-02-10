@extends('index')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box">
        <div class="box-header">
          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#tambah-supplier"><i class="fa fa-plus"></i> Tambah Baru</button>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>NO</th>
                <th>SUPPLIER</th>
                <th>ALAMAT</th>
                <th>TELEPHONE</th>
                <th>EMAIL</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $d)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $d->supplier }}</td>
                  <td>{{ $d->alamat }}</td>
                  <td>{{ $d->telp }}</td>
                  <td>{{ $d->email }}</td>
                  <td>
                    <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit-supplier{{ $d->id }}"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-default btn-sm" onclick="return del('{{ $d->id }}')"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>

                <div class="modal fade" id="edit-supplier{{ $d->id }}">
                  <div class="modal-dialog">
                    <form action="{{ url('admin/ubah_supplier', $d->id) }}" method="post"><!-- URL untuk menyimpan perubahan data supplier -->
                      @csrf
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Ubah Supplier</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="supplier_edit">Supplier</label>
                            <input type="text" class="form-control" id="supplier_edit" name="supplier_edit" required value="{{ $d->supplier }}">
                          </div>
                          <div class="form-group">
                            <label for="alamat_edit">Alamat</label>
                            <textarea name="alamat_edit" id="alamat_edit" class="form-control">{{ $d->alamat }}</textarea>
                          </div>
                          <div class="form-group">
                            <label for="telp_edit">Telephone</label>
                            <input type="text" class="form-control" id="telp_edit" name="telp_edit" required value="{{ $d->telp }}">
                          </div>
                          <div class="form-group">
                            <label for="email_edit">Email</label>
                            <input type="email" class="form-control" id="email_edit" name="email_edit" required value="{{ $d->email }}">
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


<div class="modal fade" id="tambah-supplier">
  <div class="modal-dialog">
    <form action="{{ url('admin/simpan_supplier') }}" method="post"><!-- URL untuk menyimpan data supplier -->
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Supplier</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="supplier">Supplier</label>
            <input type="text" class="form-control" id="supplier" name="supplier" required>
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="telp">Telephone</label>
            <input type="text" class="form-control" id="telp" name="telp" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
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
              title: 'Data supplier berhasil disimpan!',
              showConfirmButton: false,
              timer: 2000
            })
    <?php
      }else if(Session::get('berhasil_ubah')){
        ?>
            Swal.fire({
              icon: 'success',
              title: 'Data supplier berhasil diubah!',
              showConfirmButton: false,
              timer: 2000
            })
        <?php
      }else if(Session::get('berhasil_hapus')){
    ?>
          Swal.fire({
              icon: 'success',
              title: 'Data supplier berhasil dihapus!',
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
        //URL untuk menghapus data bahan baku
        window.location.href = "{{ url('admin/hapus_supplier') }}"+'/'+id; 
      }
    })
  }
</script>

@endsection