@extends('index')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box">
        <div class="box-header">
          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#tambah-bahan-baku"><i class="fa fa-plus"></i> Tambah Baru</button>
          <a href="{{ url('admin/kode_bahan_baku') }}" class="btn btn-default"><i class="fa fa-sun-o"></i> Kode Bahan Baku</a><!-- URL untuk membuka halaman kode bahan baku -->
          <a href="{{ url('admin/satuan') }}" class="btn btn-default"><i class="fa fa-sun-o"></i> Satuan</a><!-- URL untuk membuka halaman Satuan -->
          <a href="{{ url('admin/laporan_stok_bahan_baku_pdf') }}" target="_blank" class="btn btn-default"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>NO</th>
                <th>KODE BAHAN</th>
                <th>NAMA BAHAN</th>
                <th>NAMA SUPPLIER</th>
                <th>STOK</th>
                <th>SATUAN</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $d)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $d->kode_bahan }}</td>
                  <td>{{ $d->nama_bahan }}</td>
                  <td>{{ $d->supplier }}</td>
                  <td>{{ $d->stok }}</td>
                  <td>{{ $d->satuan }}</td>
                  <td>
                    <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit-bahan-baku{{ $d->id }}"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-default btn-sm" onclick="return del('{{ $d->id }}')"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>

                <div class="modal fade" id="edit-bahan-baku{{ $d->id }}">
                  <div class="modal-dialog">
                    <form action="{{ url('admin/ubah_bahan_baku', $d->id) }}" method="post"><!-- URL untuk menyimpan perubahan data bahan baku -->
                      @csrf
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Ubah Bahan Baku</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="kode_bahan_baku_edit">Kode Bahan Baku</label>
                            <select class="form-control select2" style="width: 100%;" id="kode_bahan_baku_edit" name="kode_bahan_baku_edit" required>
                              @foreach($kodeBahanBaku as $kbb)<!-- menampilkan data kode bahan baku -->
                                <option value="{{ $kbb->nama }}" <?php echo ($kbb->nama == $d->kode_bahan) ? 'selected':''; ?>>{{ $kbb->nama }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="nama_bahan_edit">Nama Bahan</label>
                            <input type="text" class="form-control" id="nama_bahan_edit" name="nama_bahan_edit" required value="{{ $d->nama_bahan }}">
                          </div>
                          <div class="form-group">
                            <label for="supplier_edit">Supplier</label>
                            <select class="form-control select2" style="width: 100%;" id="supplier_edit" name="supplier_edit" required>
                              @foreach($supplier as $s)<!-- menampilkan data supplier -->
                                <option value="{{ $s->id }}" <?php echo ($s->id == $d->id_supplier) ? 'selected':''; ?>>{{ $s->supplier }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="stok_edit">Stok</label>
                            <input type="number" class="form-control" id="stok_edit" name="stok_edit" min="0" step="1" required value="{{ $d->stok }}">
                          </div>
                          <div class="form-group">
                            <label for="satuan_edit">Satuan</label>
                            <select class="form-control select2" style="width: 100%;" id="satuan_edit" name="satuan_edit" required>
                              @foreach($satuan as $s)<!-- menampilkan data satuan -->
                                <option value="{{ $s->satuan }}" <?php echo ($s->satuan == $d->satuan) ? 'selected':''; ?>>{{ $s->satuan }}</option>
                              @endforeach
                            </select>
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


<div class="modal fade" id="tambah-bahan-baku">
  <div class="modal-dialog">
    <form action="{{ url('admin/simpan_bahan_baku') }}" method="post"><!-- URL untuk menyimpan data bahan baku -->
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Bahan Baku</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="kode_bahan_baku">Kode Bahan Baku</label>
            <select class="form-control select2" style="width: 100%;" id="kode_bahan_baku" name="kode_bahan_baku" required>
              @foreach($kodeBahanBaku as $kbb) <!-- Menampilkan data kode bahan baku -->
                <option value="{{ $kbb->nama }}">{{ $kbb->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="nama_bahan">Nama Bahan</label>
            <input type="text" class="form-control" id="nama_bahan" name="nama_bahan" maxlength="7" required>
          </div>
          <div class="form-group">
            <label for="supplier">Supplier</label>
            <select class="form-control select2" style="width: 100%;" id="supplier" name="supplier" required>
              @foreach($supplier as $s)<!-- menampilkan data supplier -->
                <option value="{{ $s->id }}">{{ $s->supplier }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" min="0" step="1" required>
          </div>
          <div class="form-group">
            <label for="satuan">Satuan</label>
            <select class="form-control select2" style="width: 100%;" id="satuan" name="satuan" required>
              @foreach($satuan as $ss) <!-- menampilkan data satuan -->
                <option value="{{ $ss->satuan }}">{{ $ss->satuan }}</option>
              @endforeach
            </select>
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
              title: 'Data bahan baku berhasil disimpan!',
              showConfirmButton: false,
              timer: 2000
            })
    <?php
      }else if(Session::get('berhasil_ubah')){
        ?>
            Swal.fire({
              icon: 'success',
              title: 'Data bahan baku berhasil diubah!',
              showConfirmButton: false,
              timer: 2000
            })
        <?php
      }else if(Session::get('berhasil_hapus')){
    ?>
          Swal.fire({
              icon: 'success',
              title: 'Data bahan baku berhasil dihapus!',
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
        window.location.href = "{{ url('admin/hapus_bahan_baku') }}"+'/'+id; 
      }
    })
  }
</script>

@endsection