
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PUSTAKAKU | @yield('title')</title>

  @include('dashboard.layouts.style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  {{-- @include('dashboard.layouts.pre-loader') --}}
  @include('dashboard.layouts.navbar')
  @include('dashboard.layouts.sidebar')
  <div class="content-wrapper">
         <!-- Content Header (Page header) -->
    <div class="content-header">

      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('title')</h1>
          </div>
            {{-- @include('dashboard.layouts.breadcrumb') --}}
        </div>
      </div>
    </div>
    <!-- /.content-header -->
        @yield('content')
  </div>
  {{-- @include('dashboard.layouts.footer') --}}
  @include('dashboard.layouts.control-sidebar')
  @include('dashboard.layouts.script')

</body>
</html>
