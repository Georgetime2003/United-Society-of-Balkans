@extends('layout')
@section('header')
<script defer type="module" src="{{ asset('js/viewPost.js') }}"></script>
@endsection
@section('site_content')
<div class="background background-animated">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4 class="title my-3 fade-up">Post</h4>
                <div class="row content-animated">
                    <div class="card border-1 shadow rounded-3">
										<div class="card-body p-4">
											<div class="row">
												<div class="col-9">
													<a class="text-decoration-none title-forum"><h5>@if($post->isPinned)📌@endif @if($post->isLocked)🔒@endif {{$post->title}}</h5></a>
												</div>
												<div class="col-1 offset-lg-2 offset-md-1">
													<div class="btn-group" role="group">
														<span id="upvotes">{{$post->upvotes}}</span>
														@if($post->upvoted)
															<button type="button" class="btn" id="noupvote" style="display: block"><img src="{{ asset('images/upvoted.svg') }}" alt="Upvote" width="20" height="20"></button>
															<button type="button" class="btn" id="yesupvote" style="display: none"><img src="{{ asset('images/upvote.svg') }}" alt="Upvote" width="20" height="20"></button>
														@else
															<button type="button" class="btn" id="noupvote" style="display: none"><img src="{{ asset('images/upvoted.svg') }}" alt="Upvote" width="20" height="20"></button>
															<button type="button" class="btn" id="yesupvote" style="display: block"><img src="{{ asset('images/upvote.svg') }}" alt="Upvote" width="20" height="20"></button>
														@endif
														@if($post->user_id == Auth::user()->id || Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
														<div class="btn-group" role="group">
														<div class="dropdown show">
															<a class="btn" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																<i class="fas fa-ellipsis-v" style="height: 20px; width: 20px; align-items: center;"></i>
															</a>
															<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
																<a class="dropdown-item" id="delete" href="#">Delete</a>
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
											<p>{!! $post->content !!}</p>
											<div class="col-8">
												<p><img src="{{$post->user->avatar}}" class="avatar"> Posted by <strong> {{$post->user->name}} {{$post->user->surnames}}</strong> on <strong>{{date('d-m-Y', strtotime($post->created_at))}}</strong> at <strong>{{date('H:i', strtotime($post->created_at))}}</strong></p>
											</div>
										</div>
									</div>
									<div class="mb-2"></div>
										<div class="card border-1 shadow rounded-3">
											<div class="card-body p-4">
											<div class="col-12">
												<h5>Comments</h5>
												@if($post->comments)
												@foreach ($post->comments as $comment)
															<div>
																<img src="{{ $comment->user->avatar }}" class="avatar" alt="User Image"> <strong>{{$comment->user->name}} {{$comment->user->surnames}}</strong>
																<p>{{$comment->content}}</p>
																<p>Posted in <strong>{{date('d-m-Y', strtotime($comment->created_at))}}</strong> at <strong>{{date('H:i', strtotime($comment->created_at))}}</strong></p>
															</div>
												@endforeach
												@else
													<p>No comments yet</p>
												@endif
												<div class="col-12">
													@csrf
													<h5>Write a Comment!</h5>
													<textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
													<div class="mb-2"></div>
													<div class="col-12">
														<button type="button" id="submit" class="btn btn-primary">Submit</button>
													</div>
												</div>
											</div>
										</div>
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" id="post_id" value="{{$post->id}}">
	<input type="hidden" id="user_id" value="{{Auth::user()->id}}">
	<input type="hidden" id="forum_id" value="{{$post->forum_id}}">
@endsection