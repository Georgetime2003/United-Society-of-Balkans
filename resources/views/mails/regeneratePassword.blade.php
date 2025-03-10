<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<style>

	</style>
	<title>{{ $subject }}</title>
</head>
<body>
	<div style="background-color: #d5eaff; border-radius: 10px; padding: 10px;">
		<img src="https://unoy.org/web/wp-content/uploads/2021/01/Logo100mm1-300x204.png" alt="United Societies of Balkans" width="120" height="88">
	</div>
	<div>
		<h3>Greeting {{ $name }} {{ $surnames }}</h3>
		<div class="mb-2"></div>
		<div class="row">
			<div class="col-12">
				@if ($role !== "superadmin")
					<p>As you ask to the admin, here you gave your new password:</p>
				@else 
					<p>Here's your new password as you ask:</p>
				@endif
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col align-self-center">
				<h4>Password: {{ $password }}</h4>
			</div>
		</div>
		<div>
			@if ($role !== "superadmin")
				<p>With this new password you should get access to the USB platform. We also recommend when you access change your password for one that you'll remember</p>
			@else
				<p>If you didn't ask for it, please be sure to change your mail account password for not having your account hacked.</p>
			@endif
		</div>
		<br>
		<div class="row">
			<div class="offset-4 col-4">
				<a style="
					background-color: #e1eac7;
					border-radius: 10px; 
					padding: 10px; 
					border-right: auto; 
					border-left: auto; 
					display: block;
					width: 40%;
					text-align: center;
					color: black;
					font-weight: bold;
					border: 2px solid rgb(244, 251, 145);
					text-align: center; 
					"href="http://localhost">USB Platform</a>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<p>Best regards,</p>
			</div>
		</div>
</body>
</html>
	