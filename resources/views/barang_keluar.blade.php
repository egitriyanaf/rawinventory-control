@extends('index')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box">
        <div class="box-header">
          <a href="{{ url('admin/tambah_barang_keluar') }}" class="btn btn-default"><i class="fa fa-plus"></i> Tambah Baru</a><!-- URL untuk membuka halaman untuk menambah transaksi barang keluar -->
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>NO</th>
                <th>ID TRANSAKSI</th>
                <th>TANGGAL MASUK</th>
                <th>KODE BAHAN</th>
                <th>NAMA BAHAN</th>
                <th>JUMLAH</th>
                <th>TANGGAL TRANSAKSI</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $d)<!-- tampilkan semua data transaksi -->
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $d->id_transaksi }}</td>
                  <td>{{ $d->tanggal }}</td>
                  <td>{{ $d->kode_bahan }}</td>
                  <td>{{ $d->nama_bahan }}</td>
                  <td>{{ $d->jumlah }}</td>
                  <td>{{ $d->tanggal_transaksi }}</td>
                  <td>
                    <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit-barang-keluar{{ $d->id }}"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-default btn-sm" onclick="return del('{{ $d->id }}')"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>

                <div class="modal fade" id="edit-barang-keluar{{ $d->id }}"><!-- MODAL edit data -->
                  <div class="modal-dialog">
                    <form action="{{ url('admin/ubah_barang_keluar', $d->id) }}" method="post"><!-- URL untuk menyimpan perubahan barang keluar -->
                      @csrf
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Ubah Barang Masuk</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="id_transaksi_edit">ID Transaksi</label>
                            <input type="text" class="form-control" id="id_transaksi_edit" name="id_transaksi_edit" readonly required value="{{ $d->id_transaksi }}">
                          </div>
                          <div class="form-group">
                            <label for="tanggal_edit">Tanggal Masuk</label>
                            <input type="date" class="form-control" id="tanggal_edit" name="tanggal_edit" value="{{ $d->tanggal }}" required>
                          </div>
                          <div class="form-group">
                            <label for="id_nama_bahan_edit">Nama Bahan</label>
                            <select class="form-control select2" style="width: 100%;" id="id_nama_bahan_edit" name="id_nama_bahan_edit" required>

                              @foreach($bahan as $b)<!-- tampilkan data bahan -->
                                <option value="{{ $b->id }}" <?= ($b->id == $d->id_bahan) ? 'selected':false; ?>>{{ $b->nama_bahan }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="jumlah_edit">Jumlah</label>
                            <input type="number" class="form-control" min="0" step="1" id="jumlah_edit" name="jumlah_edit" required value="{{ $d->jumlah }}">
                            <input type="hidden" class="form-control" id="jumlah_edit_old" name="jumlah_edit_old" required value="{{ $d->jumlah }}">
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



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready(function () {
  <?php 
      if (Session::get('berhasil')) {
        ?>
            Swal.fire({
              icon: 'success',
              title: 'Data berhasil disimpan!',
              showConfirmButton: false,
              timer: 2000
            })
    <?php
      }else if(Session::get('berhasil_ubah')){
        ?>
            Swal.fire({
              icon: 'success',
              title: 'Data berhasil diubah!',
              showConfirmButton: false,
              timer: 2000
            })
        <?php
      }else if(Session::get('berhasil_hapus')){
    ?>
          Swal.fire({
              icon: 'success',
              title: 'Data berhasil dihapus!',
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
        window.location.href = "{{ url('admin/hapus_barang_keluar') }}"+'/'+id; 
      }
    })
  }
</script>

@endsection