@extends('layout')
@section('header')
<script defer type="module" src="{{ asset('js/indexforum.js') }}"></script>
@endsection
@section('site_content')
<div class="background-fixed background-animated">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 data-header="h1" class="title my-5 fade-up">Create Post in <strong>{{$forum->title}}'s</strong> Forum</h2>
                <div class="row content-animated">
                    <div class="card border-1 shadow rounded-3">
                        <div class="card-body p-4">
							<div class="row">
								<div class="col-12">
									<form action="/forum/{{$forum->id}}/createPost" method="POST">
										@csrf
										<div class="mb-3">
											<label for="title" class="form-label">Title</label>
											<input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
										</div>
										<div class="mb-3">
											<label for="content" class="form-label">Content</label>
											<div class="options">
							 					<button id="bold" type="button" class="btn btn-primary">
													<i class="fas fa-bold"></i>
												</button>
												<button id="italic" type="button" class="btn btn-primary">
													<i class="fas fa-italic"></i>
												</button>
												<button id="underline" type="button" class="btn btn-primary">
													<i class="fas fa-underline"></i>
												</button>
												<button id="strikethrough" type="button" class="btn btn-primary">
													<i class="fas fa-strikethrough"></i>
												</button>
												<button id="link" type="button" class="btn btn-primary">
													<i class="fas fa-link"></i>
												</button>
												<button id="image" type="button" class="btn btn-primary">
													<i class="fas fa-image"></i>
												</button>
												<button id="superscript" class="option-button script">
													<i class="fas fa-superscript"></i>
												</button>
												<button id="subscript" class="option-button script">
													<i class="fas fa-subscript"></i>
												</button>
											<textarea class="form-control" id="content" name="content" rows="3" placeholder="Content" required></textarea>
										</div>
										<button type="submit" class="btn btn-primary">Create Post</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection