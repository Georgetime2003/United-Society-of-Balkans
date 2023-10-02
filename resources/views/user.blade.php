@csrf
@extends('layout')
@section('header')
<script src="{{ asset('js/user.js') }}"></script>
@endsection
@section('site_content')
<div class="toast align-items-center text-bg-success border-0 position-absolute my-3 top-0 start-50 translate-middle-x" role="alert" aria-live="assertive" aria-atomic="true">
	<div class="d-flex">
		<div class="toast-body">
			The user has been updates successfully
		</div>
		<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
	</div>
</div>
<div class="toast align-items-center text-bg-danger border-0 position-absolute my-3 top-0 start-50 translate-middle-x" style="z-index: 99" role="alert" aria-live="assertive" aria-atomic="true">
	<div class="d-flex">
		<div class="toast-body">
			There was an error updating the user, check if the mail is not already in use by another user
		</div>
		<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
	</div>
</div>
<div class="background-fixed">
	<div class="container">
	<div class="row">
		<div class="mb-3"></div>
		<div class="col-12 my-3">
			<h2>{{$user->name}} {{$user->surnames}}</h2>
		</div>
		<div class="mb-2"></div>
		<div class="col-md-4 col-12">
			<img src="{{$user->avatar}}" alt="Avatar" width="auto" height="200" class="d-inline-block mainAvatar">
			<div class="mb-2"></div>
			@if(!$admin)
			<button type="button" class="btn btn-primary justify-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
				Change Avatar
			</button>
			@endif
			<div class="mb-2"></div>
		</div>
		<div class="col-md-8 col-12">
			<div class="card" style="width: 100%;">
				<div class="card-body">
					<h3 class="card-title">Volunteer data</h3>
					<div class="row">
						<div class="col-md-6 col-12">
							<div class="form-floating mb-3">
								<input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required {{$admin ? '' : 'disabled'}}>
								<label for="name" class="form-label">Name:</label>
							</div>
						</div>
						<div class="col-md-6 col-12">
							<div class="form-floating mb-3">
								<input type="text" class="form-control" id="surnames" name="surnames" value="{{$user->surnames}}" required {{$admin ? '' : 'disabled'}}>
								<label for="surnames" class="form-label">Surname:</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-floating mb-3">
								<input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required {{$admin ? '' : 'disabled'}}>
								<label for="email" class="form-label">Email:</label>
							</div>
						</div>
						@if (Auth::user()->id == $user->id)
						<div class="col-md-6 col-12">
							<div class="form-floating mb-3">
								<input type="password" class="form-control" id="password" name="password" {{$admin ? '' : 'disabled'}}>
								<label for="password" class="form-label">Password:</label>
							</div>
						</div>
						<div class="col-md-6 col-12">
							<div class="form-floating mb-3">
								<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" {{$admin ? '' : 'disabled'}}>
								<label for="password_confirmation" class="form-label">Confirm password:</label>
							</div>
						</div>
						@endif
						<div class="col-12">
							<div class="form-floating">
								<select class="form-select" id="role" name="role" aria-label="Floating label select example" {{$admin ? '' : 'disabled'}}>
									<option value="0" @if($user->role == "user") selected @endif>Select an option</option>
									<option value="1" @if($user->role == "volunteer") selected @endif>Volunteer</option>
									<option value="2" @if($user->role == "house") selected @endif>House Manager</option>
									<option value="3" @if($user->role == "organization") selected @endif>Organization</option>
									<option value="4" @if($user->role == "admin") selected @endif>Admin</option>
								</select>
								<label for="role" class="form-label">Role:</label>
							</div>
							<div class="mb-3"></div>
						</div>
						<div id="volunteer1" class="col-md-6 col-12 mb-3" style="display: none">
							<div class="form-floating">
								<input type="date" class="form-control" id="starting_date" name="starting_date" value="{{$user->start_date}}" {{$admin ? '' : 'disabled'}}>
								<label for="starting_date" class="form-label">Starting date:</label>
							</div>
						</div>
						<div id="volunteer2" class="col-md-6 col-12 mb-3" style="display: none">
							<div class="form-floating">
								<input type="date" class="form-control" id="ending_date" name="ending_date" value="{{$user->end_date}}" {{$admin ? '' : 'disabled'}}>
								<label for="ending_date" class="form-label">Ending date:</label>
							</div>
						</div>
						<div id="volunteer3" class="col-12" style="display: none">
							<div class="form-floating">
								<input type="text" class="form-control" id="volunteer_code" name="volunteer_code" value="{{$user->volunteer_code}}" {{$admin ? '' : 'disabled'}}>
								<label for="volunteer_code" class="form-label">Project code:</label>
							</div>
							<div class="mb-2"></div>
						</div>
						<div id="volunteer4" class="col-md-6 col-12" style="display: none">
							<div class="form-floating mb-3">
								<input type="text" class="form-control" id="hosting" name="hosting" value="{{$user->hosting}}" {{$admin ? '' : 'disabled'}}>
								<label for="hosting" class="form-label">Hosting Organization:</label>
							</div>
						</div>
						<div id="volunteer5" class="col-md-6 col-12" style="display: none">
							<div class="form-floating mb-3">
								<input type="text" class="form-control" id="sending" name="sending" value="{{$user->sending}}" {{$admin ? '' : 'disabled'}}>
								<label for="sending" class="form-label">Sending Organization:</label>
							</div>
						</div>
						<div id="volunteer6" class="col-12" style="display: none">
							<div class="form-floating mb-3">
								<select class="form-select" id="organization_id" name="organization_id" aria-label="Floating label select example" {{$admin ? '' : 'disabled'}}>
									<option value="0">Select an option</option>
									@foreach ($organizations as $organization)
									<option value="{{$organization->id}}" @if($user->organization_id == $organization->id) selected @endif>{{$organization->organization_name}}</option>
									@endforeach
								</select>
								<label for="organization_id" class="form-label">Organization:</label>
							</div>
						</div>
						<div id="organization" class="col-12" style="display: none">
							<div class="form-floating mb-3">
								<input type="text" class="form-control" id="organization_name" name="organization_name" value="{{$user->organization_name}}" {{$admin ? '' : 'disabled'}}>
								<label for="organization_name" class="form-label">Organization name:</label>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-muted">
					<button type="submit" id="save" class="btn btn-primary" {{$admin ? '' : 'hidden'}}>Save</button>
					<a type="submit" href="{{route('user.regenerate'), $user->id}}" class="btn btn-primary" {{Auth::user()->role == 'superadmin' ? '' : 'hidden'}}>Regenerate User's Password</a>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="exampleModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Change Avatar</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="form" method="POST" action="{{ route('users.updateAvatar', $user->id) }}" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="mb-3">
						<div class="alert alert-info" id="error">
							The image is recommended to be 200x200 pixels. <br>This photo will be crop to a square, it's recommended to upload a square image or crop it before uploading.
						</div>
						<label for="avatar" class="form-label">Avatar</label>
						<input type="file" class="form-control" id="avatar" name="avatar" accept="image/*" required>
					</div>
					<button type="submit" id="submit" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<input type="hidden" id="id" value="{{$user->id}}">
@endsection