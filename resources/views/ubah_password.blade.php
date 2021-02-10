@extends('index')

@section('content')

<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    @if(Session::get('gagal'))
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span><i class="icon fa fa-ban"></i> {{ Session::get('gagal') }}!</span>
    </div>
    @endif
    <div class="box">
<!--         <div class="box-header">
        </div> -->
        <div class="box-body">
          <form action="{{ url('admin/simpan_ubah_password/'.$getData->email) }}" method="post" id="form_ubah_password">
            @csrf
            <div class="form-group">
                <label for="password_lama">Password Lama</label>
                <input id="password_lama" type="password" class="form-control" name="password_lama" required>
              </div>
              <div class="form-group">
                <label for="password_baru">Password Baru</label>
                <input id="password_baru" type="password" class="form-control" name="password_baru" required>
              </div>
  {{--
              <input type="text" name="password_aktif" value="{{ $password }}">
  --}}
              <button type="submit" id="ubah_password" class="btn btn-default"><i class="fa fa-save"></i> Simpan Perubahan</button>
          </form>
        </div>
      </div>
  </div>
  <div class="col-md-3"></div>
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

  // $('#form_ubah_password').submit(function () {
  //   passBaru = $('#password_baru').val();
  //   passLama = $('#password_lama').val();

  //   if(passBaru != passLama){
  //     alert("");
  //     return false;
  //   }
  // });

  <?php 
      if (Session::get('berhasil')) {
        ?>
            Swal.fire({
              icon: 'success',
              title: 'Password berhasil disimpan!',
              showConfirmButton: false,
              timer: 2000
            })
    <?php
      }
    ?>
 });

</script>

@endsection