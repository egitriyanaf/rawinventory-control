<!DOCTYPE html>
<html>
<head>
  
  @include('layouts.head')

  <style type="text/css">
    html {
        overflow: scroll;
        overflow-x: hidden;
    }
    ::-webkit-scrollbar {
        width: 4px;  /* Remove scrollbar space */
        background: transparent;  /* Optional: just make scrollbar invisible */
    }
    /* Optional: show position indicator in red */
    ::-webkit-scrollbar-thumb {
        background: #FF0000;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- HEADER -->
  <header class="main-header">
    @include('layouts.header')
  </header>

  <!-- SIDEBAR -->
  <aside class="main-sidebar">
    @include('layouts.sidebar')
  </aside>

  <!-- CONTENT -->
  <div class="content-wrapper">
    
    <!-- CONTENT HEADER -->
    <section class="content-header">
      <h1>
        {{ $header }}
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <?php echo $breadcrumb; ?>
      </ol>
    </section>

    <!-- MAIN CONTENT -->
    <section class="content">
      @yield('content')
    </section>
  </div>

    @include('layouts.footer')
  <!-- CONTROL SIDE -->
  <aside class="control-sidebar control-sidebar-dark" style="display: none;">
    @include('layouts.control_side')
  </aside>
  <div class="control-sidebar-bg"></div>
</div>

    @include('layouts.js')
</body>
</html>
