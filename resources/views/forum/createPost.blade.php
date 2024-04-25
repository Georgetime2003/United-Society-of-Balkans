@extends('layout')
@section('header')
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
<script src="{{ asset('quill/quill.min.js') }}"></script>
<script defer src="{{ asset('js/post.js') }}"></script>
<!--Fonts Arial, Arial Black, Comic Sans MS, Courier New, Georgia, Impact, Lucida Sans Unicode, Tahoma, Times New Roman, Trebuchet MS, Verdana-->

<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
@endsection
@section('site_content')
<div class="background-fixed background-animated">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 data-header="h1" class="title my-4 fade-up">Create Post in <strong>{{$forum->title}}'s</strong> Forum</h3>
                <div class="row content-animated">
                    <div class="card border-1 shadow">
                        <div class="card-body p-3">
							<div class="row">
								<form action="/forum/{{$forum->id}}/post" method="POST">
								<div class="col-12">
										@csrf
										<div class="mb-2">
											<label for="title" class="form-label">Title</label>
											<input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
										</div>
										<div class="mb-2 mx-auto" style="width: 80%; height: 300px">
											<div id="toolbar"></div>
											<div id="editor"></div>
										</div>
									</div>
									<div class="col-1 offset-11">
										<a id="submit" class="btn btn-primary">Create Post</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" id="forum_id" value="{{$forum->id}}">
@endsection