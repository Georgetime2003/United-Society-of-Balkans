<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<title>{{ $subject }}</title>
</head>
<body>
	<h3>Greeting {{ $name }} {{ $surnames }}</h3>
    Your account has been created in the United Societies of Balkans platform. You can access it with this email that has been linked to a Google or Facebook Account.<br>
    You will start recieving emails from {{ date('d-m-Y', strtotime($start_date)) }} to {{ date('d-m-Y', strtotime($end_date)) }} for the management of your volunteer in United Societies of Balkans.
    <div class="mb-2"></div>
	<p>Best regards,</p>
	<!-- Draw a line -->
	<hr>
	<div class="mb-2"</div>
	<img src="https://unoy.org/web/wp-content/uploads/2021/01/Logo100mm1-300x204.png" alt="United Societies of Balkans" width="120" height="88">
	<h4>United Societies of Balkans (U. S. B.)</h4>
</body>
</html>