@extends('header')
@section('content')
<nav class="navbar bg-body-tetriary" style="background-color: #00B5AD;">
	<div class="container-fluid">
	  <a class="navbar-brand" href="/users">
		<img src="/images/logonav.png" alt="Logo" width="40" height="38" class="d-inline-block">
	  </a>
	  <div class="d-flex">
		@if (Auth::user())
			@if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
				<a class="btn btn-outline-light me-2" href="/users">Users</a>
				<a class="btn btn-outline-light me-2" href="/forum">Forum</a>
				<a class="btn btn-outline-light me-2" href="/reports">Reports</a>
				<a class="btn btn-danger me-2" href="/logout" onclick="logout(event)">Logout</a>
			@elseif (Auth::user()->role == 'volunteer')
				<a class="btn btn-outline-light me-2" href="/reports/{{Auth::user()->id}}">Reports</a>
				<a class="btn btn-outline-light me-2" href="/forum">Forum</a>
				<a class="btn btn-outline-light me-2" href="/user/config">Account</a>
				<a class="btn btn-danger me-2" href="/logout" onclick="logout(event)">Logout</a>
			@elseif (Auth::user()->role == 'housemanager')
				<a class="btn btn-outline-light me-2" href="/forum">Forum</a>
				<a class="btn btn-outline-light me-2" href="/logout" onclick="logout(event)">Logout</a>
			@endif
		@endif
	  </div>
	</div>
</nav>
<script>
	function logout() {
		event.preventDefault();
		if (confirm('Are you sure you want to logout?')) {
			window.location.href = "/logout";
		}
	}
</script>
  @yield('site_content')