
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | {{ $title }}</title>

 @include('layouts.parts-auth.style')
</head>
<body class="hold-transition login-page">
  @yield('content')
@include('layouts.parts-auth.script')
</body>
</html>
