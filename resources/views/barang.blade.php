@extends('index')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box">
        <div class="box-header">
          <!-- <h3 class="box-title">Data Stok Barang</h3> -->
          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#tambah-barang"><i class="fa fa-plus"></i> Tambah Baru</button>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>NO</th>
                <th>ID BARANG</th>
                <th>NAMA BARANG</th>
                <th>KATEGORI</th>
                <th>STOK</th>
                <th>SATUAN</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $d)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $d->kode }}</td>
                  <td>{{ $d->nama }}</td>
                  <td>{{ $d->kategori }}</td>
                  <td>{{ $d->stok }}</td>
                  <td>{{ $d->satuan }}</td>
                  <td>
                    <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit-barang{{ $d->kode }}"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-default btn-sm" onclick="return del('{{ $d->kode }}')"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>

                <div class="modal fade" id="edit-barang{{ $d->kode }}">
                  <div class="modal-dialog">
                    <form action="{{ url('admin/ubah_barang',$d->kode) }}" method="post">
                      @csrf
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Edit Barang {{ $d->nama }} - {{ $d->kode }}</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="id_barang_edit">ID Barang</label>
                            <input type="text" class="form-control" id="id_barang_edit" name="id_barang_edit" value="{{ $d->kode}}" readonly required>
                          </div>
                          <div class="form-group">
                            <label for="nama_barang_edit">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang_edit" name="nama_barang_edit" required value="{{ $d->nama }}">
                          </div>
                          <div class="form-group">
                            <label for="kategori_edit">Kategori</label>
                            <select class="form-control select2" style="width: 100%;" id="kategori_edit" name="kategori_edit" required>
                              <option selected="selected">{{ $d->kategori}}</option>
                              <option>None</option>
                              <option>None</option>
                              <option>None</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="satuan_edit">Satuan</label>
                            <select class="form-control select2" style="width: 100%;" id="satuan_edit" name="satuan_edit" required>
                              <option selected="selected">{{ $d->satuan }}</option>
                              <option>None</option>
                              <option>None</option>
                              <option>None</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="stok_edit">Stok</label>
                            <input type="number" min="0" step="1" class="form-control" id="stok_edit" name="stok_edit" value="{{ $d->stok }}" required>
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


<div class="modal fade" id="tambah-barang">
  <div class="modal-dialog">
    <form action="{{ url('admin/simpan_barang') }}" method="post">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Barang</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="id_barang">ID Barang</label>
            <input type="text" class="form-control" id="id_barang" name="id_barang" value="{{ $kode }}" readonly required>
          </div>
          <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
          </div>
          <div class="form-group">
            <label for="kategori">Kategori</label>
            <select class="form-control select2" style="width: 100%;" id="kategori" name="kategori" required>
              @foreach($kategori as $k)
                <option value="{{ $k->kategori }}">{{ $k->kategori }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="satuan">Satuan</label>
            <select class="form-control select2" style="width: 100%;" id="satuan" name="satuan" required>
              @foreach($satuan as $s)
                <option value="{{ $s->satuan }}">{{ $s->satuan }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" min="0" step="1" class="form-control" id="stok" name="stok" required>
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
              title: 'Data barang berhasil disimpan!',
              showConfirmButton: false,
              timer: 2000
            })
    <?php
      }else if(Session::get('berhasil_ubah')){
        ?>
            Swal.fire({
              icon: 'success',
              title: 'Data barang berhasil diubah!',
              showConfirmButton: false,
              timer: 2000
            })
        <?php
      }else if(Session::get('berhasil_hapus')){
    ?>
          Swal.fire({
              icon: 'success',
              title: 'Data barang berhasil dihapus!',
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
        window.location.href = "{{ url('admin/hapus_barang') }}"+'/'+id;
      }
    })
  }
</script>


@endsection

