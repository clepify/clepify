<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CLEPify">
  <meta name="author" content="Andhika Dwi Khalisyahputra">
  <title>@yield('title') | {{ config('app.name') }}</title>

  {{-- Scripts --}}
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

@yield('body')

</html>
