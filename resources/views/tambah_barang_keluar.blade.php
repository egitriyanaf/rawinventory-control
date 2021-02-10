@extends('index')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box">
        <form action="{{ url('admin/simpan_transaksi_bahan_baku_keluar') }}" method="post"><!-- URL untuk menyimpan transaksi barang keluar -->
          @csrf
          <div class="box-header">
            <button type="button" class="btn btn-default" onclick="myFunction()">Tambah</button><!-- tambah baris item baru -->
            <button type="submit" class="btn btn-default">Simpan Transaksi</button>
            <input type="hidden" readonly name="id_transaksi" value="{{ $idTransaksi }}">
          </div>
          <div class="box-body">
            <table id="myTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>NAMA BAHAN</th>
                  <th>TANGGAL KELUAR</th>
                  <th>JUMLAH</th>
                  <th>SISA STOK</th>
                  <th>AKSI</th>
                </tr>
              </thead>
            </table>
          </div>
        </form>
      </div>
  </div>
</div>

<script>

//fungsi untk menambah bari baru pada item transaksi
function myFunction() {
  var table = document.getElementById("myTable");
  var rowCount = table.rows.length;
  var row = table.insertRow(rowCount);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  var cell5 = row.insertCell(4);
  var cell6 = row.insertCell(5);

  <?php
    $opt = ''; 
    foreach ($getBahan as $b) {
      $opt .="<option data-stok='".$b->stok."' value='".$b->id."'>".$b->nama_bahan."</option>";
    }
   ?>
  cell1.innerHTML = "<select class='form-control select2' id='nama_bahan"+rowCount+"' onChange='return setStok("+rowCount+")' name='nama_bahan[]'><option disabled selected>-- Pilih Bahan --</option><?php echo $opt; ?></select>";
  cell2.innerHTML = "<input type='date' class='form-control' name='tanggal_masuk[]'>";
  cell3.innerHTML = "<input type='number' class='form-control' id='jumlah"+rowCount+"' onkeyup='hitungSisaStok("+rowCount+",this.value)'  onChange='hitungSisaStok("+rowCount+",this.value)' name='jumlah[]' required>";
  cell4.innerHTML = "<input type='number' class='form-control' readonly id='sisa_stok"+rowCount+"' name='sisa_stok[]'>";
  cell5.innerHTML = "<button type='button' class='btn btn-default'>Hapus</button>";
  cell5.onclick = function() {
    myDeleteFunction(this.parentNode.rowIndex);
  }
  cell6.innerHTML = "<input type='hidden' class='form-control' readonly id='sisa_stok_old"+rowCount+"'>";
}

//fungsi untuk menghitung sisa stok pada gudang ketika jumlah stok barang keluar diinput
function hitungSisaStok(id,val) {
  var getInput = document.getElementById("jumlah"+id);
  var getStok = document.getElementById("sisa_stok"+id);
  var sisa_stok_old = document.getElementById("sisa_stok_old"+id);
  var hasil = sisa_stok_old.value - getInput.value;

  var list = document.getElementById("nama_bahan"+id);
  var listValue = list.value;
  if (listValue == '-- Pilih Bahan --') {
    alert('Silahkan pilih nama bahan terlebih dahulu!');
    getInput.value = "";
  }else{
    if(hasil < 0){
      alert('Sisa stok tidak boleh kurang dari 0.');
      getInput.value = 0;
    }else{
      getStok.value = hasil;
    }
  }
}


//fungsi untuk menampilkan sisa stok
function setStok(x){
    var ddl = document.getElementById("nama_bahan"+x);
    var selectedOption = ddl.options[ddl.selectedIndex];
    var mailValue = selectedOption.getAttribute("data-stok");
    var textBox = document.getElementById("sisa_stok"+x);
    var sisa_stok_old = document.getElementById("sisa_stok_old"+x);
    textBox.value = mailValue;
    sisa_stok_old.value = mailValue;

    document.getElementById("jumlah"+x).value = "";
}


//fungsi untuk menghapus baris item transaksi
function myDeleteFunction(x) {
  document.getElementById("myTable").deleteRow(x);
}
</script>


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
      }
    ?>
 });

</script>

@endsection

