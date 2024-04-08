@extends('header')
@section('content')
<nav class="navbar bg-body-tetriary" style="background-color: #00B5AD;">
	<div class="container-fluid">
	  <a class="navbar-brand" href="/home">
		<img src="/images/logonav.png" alt="Logo" width="40" height="38" class="d-inline-block">
	  </a>
	  <div class="d-flex">
		<a class="btn linkmenubar me-2" href="/home"><i class="fas fa-home" style="width: 20px; margin-top: 20%"></i></a>
		@if (Auth::user())
			<a class="btn linkmenubar me-2" href="/user/config"><i class="fas fa-user" style="width: 20px; margin-top: 20%"></i></a>
			@if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
			<a class="btn linkmenubar me-2" href="/users">Users</a>
			<a class="btn linkmenubar me-2" href="/forum">Forum</a>
			<a class="btn linkmenubar me-2" href="/reports">Reports</a>
			<a class="btn linkmenubar me-2" href="/organizations">Organizations</a>
			@elseif (Auth::user()->role == 'volunteer')
				<a class="btn linkmenubar me-2" href="/reports/{{Auth::user()->id}}">Reports</a>
				<a class="btn linkmenubar me-2" href="/forum">Forum</a>
			@elseif (Auth::user()->role == 'housemanager')
				<a class="btn linkmenubar me-2" href="/forum">Forum</a>
			@elseif (Auth::user()->role == 'organization')
				<a class="btn linkmenubar me-2" href="/organization/{{Auth::user()->id}}">Reports</a>
			@endif
			@endif
			<a class="btn linkmenulogout me-2" href="/logout" onclick="logout(event)"><i class="fa-solid fa-arrow-right-from-bracket" style="margin-top: 20%; margin-left: 8%"></i></a>
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