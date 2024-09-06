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
				<p>Welcome to the USB Platform, where you'll be able to access when you project starts in {{ date('jS \\of F, Y', strtotime($start_date)) }}. You will be able to see the information of your volunteering, access to a forum with all the news of the NGO and House communication.</p>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col align-self-center">
				<h4>Password: {{ $password }}</h4>
			</div>
		</div>
		<div>
				<p>You will get able to change the password in your account settings and log-in with Online services such as Google or Facebook if the email that we sent to you is linked to those services.</p>
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
					"href="https://esidis.balkanhotspot.org/">USB Platform</a>
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