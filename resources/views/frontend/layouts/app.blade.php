<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.5">
  <title>Book Sharing</title>

  @include('frontend.layouts.partials.style')

  @yield('styles')

</head>
<body>

  @include('frontend.layouts.partials.header')

  @yield('content')

  @include('frontend.layouts.partials.footer')

  @include('frontend.layouts.partials.script')

  @yield('scripts')

</body>
</html>
