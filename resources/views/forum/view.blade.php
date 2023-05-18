@extends('layout')
@section('header')
<script defer type="module" src="{{ asset('js/indexforum.js') }}"></script>
@endsection
@section('site_content')
<div class="background background-animated">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 data-header="h1" class="title my-5 fade-up">{{$forum->title}}</h2>
                <div class="row content-animated">
                    <div class="card border-1 shadow rounded-3">
                        <div class="card-body p-4">
                            <div class="row">
								<div class="col-4">
									<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCreatePost">
										<i class="fas fa-plus"></i>  Create Post
									</button>
								</div>
								<div class="col-1 offset-3">
									<label for="orderby" class="form-label">Order By:</label>
								</div>
								<div class="col-4">
									<!--Order by-->
									<select class="form-select" aria-label="Default select example" onchange="orderBy(this.value)">
										<option value="newest">Newest</option>
										<option value="oldest">Oldest</option>
										<option value="upvotes">Upvotes</option>
									</select>
								</div>
								<div class="mb-2"></div>
								@foreach ($posts as $post)
									<div class="mb-2"></div>
									<div class="card border-1 shadow rounded-3">
										<div class="card-body p-4">
											<div class="row">
												<div class="col-9">
													<a href="/forum/{{$forum->id}}/{{$post->id}}" class="text-decoration-none title-forum"><h5>@if($post->isPinned)📌@endif @if($post->isLocked)🔒@endif {{$post->title}}</h5></a>
												</div>
												<div class="col-1 offset-lg-2 offset-md-1">
													<div class="btn-group" role="group">
														@if ($forum->upvotes)
														@if($post->upvoted)
															<button type="button" class="btn" onclick="upvote({{$post->id}})"><img src="{{ asset('images/upvoted.svg') }}" alt="Upvote" width="20" height="20"></button>
														@else
															<button type="button" class="btn" onclick="upvote({{$post->id}})"><img src="{{ asset('images/upvote.svg') }}" alt="Upvote" width="20" height="20"></button>
														@endif
														@endif
														@if($post->user_id == Auth::user()->id || Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
														<div class="btn-group" role="group">
														<div class="dropdown show">
															<a class="btn" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																<i class="fas fa-ellipsis-v" style="height: 20px; width: 20px; align-items: center;"></i>
															</a>
															<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
																<a class="dropdown-item" href="/forum/{{$forum->id}}/delete">Delete</a>
																<a class="dropdown-item" href="#">Another action</a>
																<a class="dropdown-item" href="#">Something else here</a>
															</div>
														</div>
														</div>
														@endif
													</div>
												</div>
												<div class="col-1 justify-content-end">
												</div>
											</div>
											<div class="mb-2"></div>
											@if ($post->image)
												<div class="col-12">
													<img src="{{ asset('storage/images/'.$post->image) }}" alt="Post Image" width="100%" height="auto">
												</div>
											@endif
											<p>{{$post->content}}</p>
											<div class="col-8">
												<p>Posted by <strong>{{$post->user->name}} {{$post->user->surnames}}</strong> on <strong>{{date('d-m-Y', strtotime($post->created_at))}}</strong> at <strong>{{date('H:i', strtotime($post->created_at))}}</strong></p>
											</div>
											<div class="col-12">
												<h5>Comments</h5>
												@if($post->comments)
												@foreach ($post->comments as $comment)
														<div class="card border-1 shadow rounded-3">
															<div class="card-body p-4">
																<p>{{$comment->content}}</p>
																<p>Posted by <strong>{{$comment->user->name}} {{$comment->user->surnames}}</strong> on <strong>{{$comment->created_at}}</strong></p>
															</div>
														</div>
												@endforeach
												@else
													<p>No comments yet</p>
												@endif
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection