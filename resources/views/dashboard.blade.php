@extends('index')

@section('content')
{{--
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>{{ $bahanBaku->jml }}</h3>

        <p>Data Bahan Baku</p>
      </div>
      <div class="icon">
        <i class="fa fa-cube"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
        <h3>{{ $bahanBakuMasuk->jml }}</h3>

        <p>Bahan Baku Masuk</p>
      </div>
      <div class="icon">
        <i class="fa fa-cubes"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>{{ $bahanBakuKeluar->jml }}</h3>

        <p>Bahan Baku Keluar</p>
      </div>
      <div class="icon">
        <i class="fa fa-cubes"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
      <div class="inner">
        <h3>{{ $users->jml }}</h3>

        <p>User</p>
      </div>
      <div class="icon">
        <i class="fa fa-users"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>
--}}

<div class="row">
  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <i class="fa fa-text-width"></i>

        <h3 class="box-title">SEJARAH</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <p>
          PT Aneka Sarivita didirikan pada tahun 1990 oleh bapak Ir. Herman Moeliana. Pendirian perusahaan ini dilatar belakangi keinginan dari pemilik untuk berkontribusi pada pemenuhan kebutuhan gizi dari masyarakat Indonesia, terutama kebutuhan akan sumber protein.
        </p>
        <p>
          Protein dapat berasal dari sumber yang bersifat hewani atau nabati. PT Aneka Sarivita berfokus pada pemenuhan kebutuhan akan sumber protein yang berasal dari nabati, karena sumber protein hewani masih relative mahal dibanding dengan yang berasal dari nabati.
        </p>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <i class="fa fa-text-width"></i>

        <h3 class="box-title">VISI</h3>
      </div>
      <div class="box-body">
        <p>
          Menjadi perusahaan terkemuka penyedia makanan sehat yang terjangkau  dan bermutu tinggi
        </p>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <i class="fa fa-text-width"></i>

        <h3 class="box-title">MISI</h3>
      </div>
      <div class="box-body">
        <p>
          Memasarkan produk makanan sehat dengan selalu mengacu kepada standar mutu, food safety management dan halal
        </p>
      </div>
    </div>
  </div>
</div>
@endsection