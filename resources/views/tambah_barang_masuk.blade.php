@extends('index')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box">
        <form action="{{ url('admin/simpan_transaksi_bahan_baku') }}" method="post">
          @csrf
          <div class="box-header">
            <button type="button" class="btn btn-default" onclick="myFunction()">Tambah</button>
            <button type="submit" class="btn btn-default">Simpan Transaksi</button>
            <input type="hidden" readonly name="id_transaksi" value="{{ $idTransaksi }}">
          </div>
          <div class="box-body">
            <table id="myTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>NAMA BAHAN</th>
                  <th>TANGGAL MASUK</th>
                  <th>JUMLAH</th>
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
  function myFunction() {
    var table = document.getElementById("myTable");
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);

    <?php
      $opt = ''; 
      foreach ($getBahan as $b) {
        $opt .="<option value='".$b->id."'>".$b->nama_bahan."</option>";
      }
     ?>
    cell1.innerHTML = "<select class='form-control select2' name='nama_bahan[]' required><?php echo $opt; ?></select>";
    cell2.innerHTML = "<input type='date' class='form-control' name='tanggal_masuk[]' required>";
    cell3.innerHTML = "<input type='number' class='form-control' name='jumlah[]' required>";
    cell4.innerHTML = "<button type='button' class='btn btn-default'>Hapus</button>";
    cell4.onclick = function() {
      myDeleteFunction(this.parentNode.rowIndex);
    }
  }

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

