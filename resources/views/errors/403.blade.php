@extends('layout')
@section('header')
<script src="{{ asset('js/reports.js') }}"></script>
@endsection
@section('site_content')
<div class="background-fixed background-animated">
    <div class="container fade-up">
        <div class="row">
            <div class="col-12">
                <h2 data-header="h1" class="title my-5">You're not supposed to be here</h2>
				<div class="text-center">
					<img src="{{ asset('images/error.gif') }}" alt="You're not supposed to be here" class="img-fluid">
				</div>
				<br/>
				<p>Go back to <a href="/forum" class="btn btn-outline-dark">Main site</a> <small>please 😇</small></p>
            </div>
			<footer class="footer mt-auto py-3 bg-light">
				<div class="container">
					<!--Show error message-->
						<div class="alert alert-danger">
							Error 403: Forbidden
						</div>
				</div>
			</footer>
        </div>
    </div>
</div>
@endsection