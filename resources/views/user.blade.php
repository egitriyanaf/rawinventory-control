@extends('index')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box">
        <div class="box-header">
          <!-- <a href="{{ url('admin/tambah_user') }}" class="btn btn-default"><i class="fa fa-plus"></i> Tambah Baru</a> -->
          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#tambah-user"><i class="fa fa-plus"></i> Tambah Baru</button>
          <a href="{{ url('admin/hak_akses') }}" class="btn btn-default"><i class="fa fa-key"></i> Hak Akses</a>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width: 10px;">NO</th>
                <th>NAMA</th>
                <th>EMAIL</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $d)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $d->name }}</td>
                  <td>{{ $d->email }}</td>
                  <td>
                    <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit-user{{ $d->id }}"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-default btn-sm" onclick="return del('{{ $d->id }}')"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>

                <div class="modal fade" id="edit-user{{ $d->id }}">
                  <div class="modal-dialog">
                    <form method="POST" action="{{ url('admin/ubah_user/'.$d->id) }}">
                      @csrf
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Ubah User</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="name_edit">Nama</label>
                            <input id="name_edit" type="text" class="form-control" name="name_edit" value="{{ $d->name }}">
                          </div>
                          <div class="form-group">
                            <label for="email_edit">Email</label>
                            <input id="email_edit" type="email" class="form-control" name="email_edit" value="{{ $d->email }}">
                          </div>
                          <div class="form-group">
                            <label for="password_edit">Password</label>
                            <input id="password_edit" type="password" class="form-control" name="password_edit" required>
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


<div class="modal fade" id="tambah-user">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah User</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Nama</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
          </div>

          <div class="form-group">
            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
              title: 'Data user berhasil disimpan!',
              showConfirmButton: false,
              timer: 2000
            })
    <?php
      }else if(Session::get('berhasil_ubah')){
        ?>
            Swal.fire({
              icon: 'success',
              title: 'Data user berhasil diubah!',
              showConfirmButton: false,
              timer: 2000
            })
        <?php
      }else if(Session::get('berhasil_hapus')){
    ?>
          Swal.fire({
              icon: 'success',
              title: 'Data user berhasil dihapus!',
              showConfirmButton: false,
              timer: 2000
            })
    <?php

      }else if(Session::get('gagal')){
   ?>
       Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Konfirmasi password tidak sama!',
        showConfirmButton: false,
        timer: 3000
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
        window.location.href = "{{ url('admin/hapus_user') }}"+'/'+id;
      }
    })
  }
</script>

@endsection