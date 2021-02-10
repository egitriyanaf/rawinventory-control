@extends('index')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box">
        <div class="box-header">
          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#tambah-bahan-baku"><i class="fa fa-plus"></i> Tambah Baru</button>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>NO</th>
                <th>KODE BAHAN</th>
                <th>NAMA BAHAN</th>
                <th>STOK</th>
                <th>SATUAN</th>
                <th>DESKRIPSI</th>
                <th>AKSI</th>
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
                  <td>
                    <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit-bahan-baku-rusak{{ $d->id }}"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-default btn-sm" onclick="return del('{{ $d->id }}')"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>

                <div class="modal fade" id="edit-bahan-baku-rusak{{ $d->id }}">
                  <div class="modal-dialog">
                    <form action="{{ url('admin/ubah_bahan_baku_rusak', $d->id) }}" method="post"><!-- URL untuk menyimpan perubahan data bahan baku -->
                      @csrf
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Ubah Bahan Baku Rusak</h4>
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
                            <select class="form-control select2" style="width: 100%;" id="nama_bahan_edit" name="nama_bahan_edit" onchange="return setStokEdit()" required>
                              @foreach($namaBahan as $nb)<!-- menampilkan data kode bahan baku -->
                                <option value="{{ $nb->nama_bahan }}" <?php echo ($nb->nama_bahan == $d->nama_bahan) ? 'selected':''; ?>>{{ $nb->nama_bahan }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="sisa_stok_edit">Stok</label>
                            @foreach($namaBahan as $nb2)
                              @if($nb2->nama_bahan == $d->nama_bahan)
                                <input type="number" class="form-control" id="sisa_stok_edit{{$no}}" name="sisa_stok_edit" min="0" step="1" required value="{{ $nb2->stok }}" readonly>
                                <input type="hidden" class="form-control" id="sisa_stok_old_edit{{$no}}" name="sisa_stok_old_edit" min="0" step="1" required value="{{ $nb2->stok+$d->stok }}">
                              @endif
                            @endforeach
                          </div>
                          <div class="form-group">
                            <label for="stok_edit">Jumlah</label>
                            <input type="number" class="form-control" id="stok_edit{{$no}}" name="stok_edit" min="0" step="1" required value="{{ $d->stok }}" onkeyup="hitungSisaStokEdit({{$no}},this.value)" onchange="hitungSisaStokEdit({{$no}},this.value)">
                          </div>
                          <div class="form-group">
                            <label for="satuan_edit">Satuan</label>
                            <select class="form-control select2" style="width: 100%;" id="satuan_edit" name="satuan_edit" required>
                              @foreach($satuan as $s)<!-- menampilkan data satuan -->
                                <option value="{{ $s->satuan }}" <?php echo ($s->satuan == $d->satuan) ? 'selected':''; ?>>{{ $s->satuan }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="stok_edit">Deskripsi</label>
                            <textarea name="deskripsi_edit" id="deskripsi_edit" class="form-control">{{ $d->deskripsi}}</textarea>
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
    <form action="{{ url('admin/simpan_bahan_baku_rusak') }}" method="post"><!-- URL untuk menyimpan data bahan baku -->
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
            <label for="nama_bahan_rusak">Nama Bahan</label>
            <select class="form-control select2" style="width: 100%;" id="nama_bahan_rusak" name="nama_bahan_rusak" onchange="return setStok()" required>
                <option disabled selected>-- Please Select --</option>
              @foreach($namaBahan as $nbr) <!-- Menampilkan data kode bahan baku -->
                <option data-stok="{{ $nbr->stok }}" value="{{ $nbr->nama_bahan }}">{{ $nbr->nama_bahan }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="sisa_stok">Sisa Stok</label>
            <input type="number" class="form-control" id="sisa_stok" name="sisa_stok" readonly required>
            <input type="hidden" class="form-control" id="sisa_stok_old" name="sisa_stok_old">
          </div>
          <div class="form-group">
            <label for="stok">Jumlah</label>
            <input type="number" class="form-control" id="stok" name="stok" min="0" step="1" onkeyup="hitungSisaStok(this.value)"  onchange="hitungSisaStok(this.value)" required>
          </div>
          <div class="form-group">
            <label for="satuan">Satuan</label>
            <select class="form-control select2" style="width: 100%;" id="satuan" name="satuan" required>
              @foreach($satuan as $ss) <!-- menampilkan data satuan -->
                <option value="{{ $ss->satuan }}">{{ $ss->satuan }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="stok">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
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
        window.location.href = "{{ url('admin/hapus_bahan_baku_rusak') }}"+'/'+id; 
      }
    })
  }
</script>

<script type="text/javascript">
  function setStok(){
      var ddl = document.getElementById("nama_bahan_rusak");
      var selectedOption = ddl.options[ddl.selectedIndex];
      var mailValue = selectedOption.getAttribute("data-stok");
      var textBox = document.getElementById("sisa_stok");
      var sisa_stok_old = document.getElementById("sisa_stok_old");
      textBox.value = mailValue;
      sisa_stok_old.value = mailValue;

      // document.getElementById("stok").value = "";
  }

  function hitungSisaStok(val) {
    var getInput = document.getElementById("stok");
    var getStok = document.getElementById("sisa_stok");
    var sisa_stok_old = document.getElementById("sisa_stok_old");
    var hasil = sisa_stok_old.value - getInput.value;

    // var list = document.getElementById("nama_bahan");
    // var listValue = list.value;
    // if (listValue == '-- Pilih Bahan --') {
    //   alert('Silahkan pilih nama bahan terlebih dahulu!');
    //   getInput.value = "";
    // }else{
      if(hasil < 0){
        alert('Sisa stok tidak boleh kurang dari 0.');
        getInput.value = 0;
      }
      else{
        getStok.value = hasil;
      }
    // }
  }

  function setStokEdit(){
      var ddl = document.getElementById("nama_bahan_edit");
      var selectedOption = ddl.options[ddl.selectedIndex];
      var mailValue = selectedOption.getAttribute("data-stok-edit");
      var textBox = document.getElementById("sisa_stok_edit");
      var sisa_stok_old = document.getElementById("sisa_stok_old_edit");
      textBox.value = mailValue;
      sisa_stok_old.value = mailValue;

      // document.getElementById("stok").value = "";
  }

  function hitungSisaStokEdit(id,val) {
    var getInput = document.getElementById("stok_edit"+id);
    var getStok = document.getElementById("sisa_stok_edit"+id);
    var sisa_stok_old = document.getElementById("sisa_stok_old_edit"+id);
    var hasil = sisa_stok_old.value - getInput.value;

    // var list = document.getElementById("nama_bahan");
    // var listValue = list.value;
    // if (listValue == '-- Pilih Bahan --') {
    //   alert('Silahkan pilih nama bahan terlebih dahulu!');
    //   getInput.value = "";
    // }else{
      if(hasil < 0){
        alert('Sisa stok tidak boleh kurang dari 0.');
        getInput.value = 0;
      }
      else{
        getStok.value = hasil;
      }
    // }
  }
</script>

@endsection