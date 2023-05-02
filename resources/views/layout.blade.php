@extends('header')
@section('content')
<nav class="navbar bg-body-tetriary" style="background-color: #00B5AD;">
	<div class="container-fluid">
	  <a class="navbar-brand" href="/users">
		<img src="/images/logonav.png" alt="Logo" width="40" height="38" class="d-inline-block">
	  </a>
	  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
		<div class="offcanvas-header">
		  <h5 class="offcanvas-title" id="offcanvasRightLabel">Menu</h5>
		  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
	</div>
  </nav>
  @yield('site_content')