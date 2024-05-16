@extends('layout')
@section('header')
<script defer src="{{ asset('js/viewForum.js') }}"></script>
@endsection
@section('site_content')
<div class="background-fixed background-animated">
    <div class="container">
        <div class="row">
            <div class="col-12">
				<br/>
                <h2 data-header="h1" class="title my-4 fade-up">{{$forum->title}}</h3>
                <div class="row content-animated">
                    <div class="card border-1 shadow-sm rounded-3">
                        <div class="card-body p-3">
                            <div class="row">
								<div class="col-4">
									<a class="btn btn-success" href="/forum/{{$forum->id}}/post">
										<i class="fas fa-plus"></i>  Create Post
									</a>
									@if ($forum->id <= 4)
									<a href="{{ route('calendar_' . $forum->id) }}">
										<div class="card-body">
											<i class="fas fa-users start-icons fa-2x"></i>
											<span class="offset-1">Calendar</span>
										</div>
									</a>
									@endif
								
									
								</div>
								<div class="col-1 offset-3">
									<label for="orderby" class="form-label">Order By:</label>
								</div>
								<div class="col-4">
									<!--Order by-->
									<select class="form-select" aria-label="Default select example" onchange="orderBy(this.value)">
										<option value="newest">Newest</option>
										<option value="oldest">Oldest</option>
										@if ($forum->upvotes)
											<option value="upvotes">Upvotes</option>
										@endif
									</select>
								</div>
							</div>
							<hr class="my-1">
							<div class = "row forum-scroll">
								<div class="col-12">
								@php $i = 0; @endphp
								@if ($posts->isEmpty())
									<div class="mb-4"></div>
									<div class="card border-1 shadow rounded-3 fade-down-forum">
										<div class="card-body p-4">
											<p style="text-align: center;text-font: bold; font-size: 20px;">It looks like it's empty here, post something 😁</p>
										</div>
									</div>
								@endif
								@foreach ($posts as $post)
									<div class="mb-2"></div>
									<div class="card border-1 shadow rounded-3">
										<div class="card-body p-4">
											<div class="row">
												<div class="col-9">
													<a href="/forum/{{$forum->id}}/{{$post->id}}" class="text-decoration-none title-forum"><h5>@if($post->isPinned)📌@endif @if($post->isLocked)🔒@endif {{$post->title}}</h5></a>
												</div>
												<div class="col-1 @if($forum->upvotes) offset-lg-1 @else offset-lg-2 @endif offset-md-1">
													<div class="btn-group" role="group">
														@if ($forum->upvotes)
														<span id="upvotes{{$i}}" class="ps">{{$post->upvotes}}</span>
														@if($post->upvoted)
															<button type="button" class="btn" id="noupvote{{$i}}" onclick="delupvote({{$post->id}}, {{Auth::id()}}, {{$i}})" style="display: block"><img src="{{ asset('images/upvoted.svg') }}" alt="Upvote" width="20" height="20"></button>
															<button type="button" class="btn" id="yesupvote{{$i}}" onclick="upvote({{$post->id}}, {{Auth::id()}}, {{$i}})" style="display: none"><img src="{{ asset('images/upvote.svg') }}" alt="Upvote" width="20" height="20"></button>
														@else
															<button type="button" class="btn" id="noupvote{{$i}}" onclick="delupvote({{$post->id}}, {{Auth::id()}}, {{$i}})" style="display: none"><img src="{{ asset('images/upvoted.svg') }}" alt="Upvote" width="20" height="20"></button>
															<button type="button" class="btn" id="yesupvote{{$i}}" onclick="upvote({{$post->id}}, {{Auth::id()}}, {{$i}})" style="display: block"><img src="{{ asset('images/upvote.svg') }}" alt="Upvote" width="20" height="20"></button>
														@endif
														@endif
														@if($post->user_id == Auth::user()->id || Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
														<div class="btn-group" role="group">
														<div class="dropdown show">
															<button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
																<i class="fas fa-ellipsis-v" style="height: 20px; width: 20px; align-items: center;"></i>
															</button>
															<ul class="dropdown-menu">
																<li><a class="dropdown-item" id="delete"
																	href="#" data-post-id="{{$post->id}}" data-forum-id="{{$forum->id}}">Delete</a></li>
															</ul>
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
											{!! $post->content !!}
											<div class="col-8">
												<p><img src="{{$post->user->avatar}}" class="avatar"> Posted by <strong> {{$post->user->name}} {{$post->user->surnames}}</strong> on <strong>{{date('d-m-Y', strtotime($post->created_at))}}</strong> at <strong>{{date('H:i', strtotime($post->created_at))}}</strong></p>
											</div>
											<div class="col-12">
												<h5>Comments</h5>
												<div>
													@if ($post->nocoments)
														<p style="text-align: center;text-font: italic;">No comments yet</p>
													@else 
														<p><img src="{{$post->lastComment->user->avatar}}" alt="User's Image" class="avatar"> <strong>{{$post->lastComment->user->name}} {{$post->lastComment->user->surnames}}</strong></p>
														<a style="margin-left: 4%;">{{$post->lastComment->content}}</a>
														<br>
														<small style="margin-left: 4%">Posted on <strong>{{date('d-m-Y', strtotime($post->lastComment->created_at))}}</strong> at <strong>{{date('H:i', strtotime($post->lastComment->created_at))}}</strong></small>
													@endif
												</div>
											</div>
										</div>
									</div>
									@php $i++; @endphp
									<div class="mb-3"></div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection