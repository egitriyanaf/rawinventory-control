@extends('index')

@section('content')

<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <div class="box">
        <div class="box-header">
          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#tambah-kode-bahan"><i class="fa fa-plus"></i> Tambah Baru</button>
          <a href="{{ url('admin/bahan_baku') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Kembali</a><!-- URL untuk membuka halaman bahan baku -->
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>NO</th>
                <th>KODE BAHAN</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $d)<!-- menampilkan data kode bahan baku -->
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $d->nama }}</td>
                  <td>
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit-kode-bahan{{ $d->id }}"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-default btn-sm" onclick="return del('{{ $d->id }}')"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>

                <div class="modal fade" id="edit-kode-bahan{{ $d->id }}">
                  <div class="modal-dialog">
                    <form action="{{ url('admin/ubah_kode_bahan_baku',$d->id) }}" method="post"><!-- URL untuk menyimpan perubahan pada kode bahan baku -->
                      @csrf
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Ubah Kode</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="id_barang">Kode Bahan</label>
                            <input type="text" class="form-control" id="edit_kode_bahan" name="edit_kode_bahan" maxlength="15" required autofocus value="{{ $d->nama }}">
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
  <div class="col-md-3"></div>
</div>

<div class="modal fade" id="tambah-kode-bahan">
  <div class="modal-dialog">
    <form action="{{ url('admin/simpan_kode_bahan') }}" method="post"><!-- URL untuk menyimpan data kode bahan baku -->
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Kode Bahan</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="id_barang">Kode Bahan</label>
            <input type="text" class="form-control" id="kode_bahan" name="kode_bahan" maxlength="15" required autofocus>
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
        // URL untuk menghapus data kode bahan baku
        window.location.href = "{{ url('admin/hapus_kode_bahan_baku') }}"+'/'+id;
      }
    })
  }
</script>


@endsection