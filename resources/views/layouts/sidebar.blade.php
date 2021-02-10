<section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('file/logo.jpeg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
          <a href="{{ url('admin/dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>HOME</span>
          </a>
        </li>
        @if( Auth::user()->hak_bahan_baku == 1)
        <li class="treeview {{ Request::is('admin/barang','admin/bahan_baku','admin/kategori','admin/satuan','admin/bahan_baku_rusak') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-archive"></i>
            <span>BAHAN BAKU</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li class="{{ Request::is('admin/barang') ? 'active' : '' }}"><a href="{{ url('admin/barang') }}"><i class="fa fa-circle-o"></i> Data Barang</a></li> -->
            <li class="{{ Request::is('admin/bahan_baku') ? 'active' : '' }}"><a href="{{ url('admin/bahan_baku') }}"><i class="fa fa-circle-o"></i> Stok Bahan Baku</a></li>
            <li class="{{ Request::is('admin/bahan_baku_rusak') ? 'active' : '' }}"><a href="{{ url('admin/bahan_baku_rusak') }}"><i class="fa fa-circle-o"></i> Bahan Baku Rusak</a></li>
            <!-- <li class="{{ Request::is('admin/kategori') ? 'active' : '' }}"><a href="{{ url('admin/kategori') }}"><i class="fa fa-circle-o"></i> Kategori</a></li> -->
            <!-- <li class="{{ Request::is('admin/satuan') ? 'active' : '' }}"><a href="{{ url('admin/satuan') }}"><i class="fa fa-circle-o"></i> Satuan</a></li> -->
          </ul>
        </li>
        @endif
        @if( Auth::user()->hak_supplier == 1)
        <li class="{{ Request::is('admin/supplier') ? 'active' : '' }}">
          <a href="{{ url('admin/supplier') }}">
            <i class="fa fa-user"></i>
             <span>SUPPLIER</span>
          </a>
        </li>
        @endif
        @if( Auth::user()->hak_transaksi == 1)
        <li class="treeview {{ Request::is('admin/barang_masuk','admin/barang_keluar', 'admin/tambah_barang_masuk','admin/tambah_barang_keluar') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-exchange"></i>
            <span>TRANSAKSI</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('admin/barang_masuk') ? 'active' : '' }}"><a href="{{ url('admin/barang_masuk') }}"><i class="fa fa-circle-o"></i> Bahan Masuk</a></li>
            <li class="{{ Request::is('admin/barang_keluar','admin/tambah_barang_keluar') ? 'active' : '' }}"><a href="{{ url('admin/barang_keluar') }}"><i class="fa fa-circle-o"></i> Bahan Keluar</a></li>
          </ul>
        </li>
        @endif
        @if( Auth::user()->hak_laporan == 1)
        <li class="treeview {{ Request::is('admin/laporan_bahan_baku_masuk', 'admin/laporan_stok_barang', 'admin/laporan_bahan_baku_keluar','admin/laporan_bahan_masuk_filter','admin/laporan_bahan_keluar_filter','admin/laporan_bahan_baku_rusak','admin/laporan_bahan_rusak_filter') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>LAPORAN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li class="{{ Request::is('admin/laporan_stok_barang') ? 'active' : '' }}"><a href="{{ url('admin/laporan_stok_barang') }}"><i class="fa fa-circle-o"></i> Bahan Baku</a></li> -->
            <li class="{{ Request::is('admin/laporan_bahan_baku_masuk','admin/laporan_bahan_masuk_filter') ? 'active' : '' }}"><a href="{{ url('admin/laporan_bahan_baku_masuk') }}"><i class="fa fa-circle-o"></i> Bahan Baku Masuk</a></li>
            <li class="{{ Request::is('admin/laporan_bahan_baku_keluar','admin/laporan_bahan_keluar_filter') ? 'active' : '' }}"><a href="{{ url('admin/laporan_bahan_baku_keluar') }}"><i class="fa fa-circle-o"></i> Bahan Baku Keluar</a></li>
            <li class="{{ Request::is('admin/laporan_bahan_baku_rusak','admin/laporan_bahan_rusak_filter') ? 'active' : '' }}"><a href="{{ url('admin/laporan_bahan_baku_rusak') }}"><i class="fa fa-circle-o"></i> Bahan Baku Rusak</a></li>
          </ul>
        </li>
        @endif
        @if( Auth::user()->hak_user == 1)
        <li class="{{ Request::is('admin/user','admin/hak_akses') ? 'active' : '' }}">
          <a href="{{ url('admin/user') }}">
            <i class="fa fa-users"></i> <span>USER</span>
          </a>
        </li>
        @endif
        
      </ul>
    </section>