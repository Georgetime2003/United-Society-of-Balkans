@extends('header')
@section('content')
<nav class="navbar bg-body-tetriary fixed-top" style="background-color: #00B5AD;">
	<div class="container-fluid">
	  <a class="navbar-brand" href="/users">
		<img src="/images/logonav.png" alt="Logo" width="40" height="38" class="d-inline-block">
	  </a>
	</div>
  </nav>
  @yield('site_content')