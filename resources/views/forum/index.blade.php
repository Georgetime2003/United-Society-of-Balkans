@extends('layout')
@section('header')
<script defer type="module" src="{{ asset('js/indexforum.js') }}"></script>
@endsection
@section('site_content')
<div class="background-fixed background-animated">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 data-header="h1" class="title my-5 fade-up">Forums</h2>
                <div class="row content-animated">
                    <div class="card border-1 shadow rounded-3">
                        <div class="card-body p-4">
                            <div class="row">
                                @if($admin)
                                <div class="col-2 offset-10">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCreateForum">
                                        Create Forum
                                    </button>
                                    <a href="{{ route('calendar') }}" class="linkmenu">
                                        <div class="card-body">
                                            <i class="fas fa-users start-icons fa-2x"></i>
                                            <span class="offset-1">Calendar</span>
                                        </div>
                                    </a>
                                    <div class="mb-2"></div>
                                </div>
                                @endif
                                <div class="mb-2"></div>
                                <div class="col-12 top-3">
                                    @foreach ($forums as $forum)
										<div class="card border-1 shadow rounded-3">
											<div class="card-body p-4">
												<a href="/forum/{{$forum->id}}" class="text-decoration-none title-forum"><h4>{{$forum->title}}</h4></a>
												@if ($forum->hasPinned)
                                                <a class="text-decoration-none" href="{{ route('forum.viewPost', ['idforum' => $forum->id, 'idpost' => $forum->pinnedPost->id]) }}">
													<div class="card card-selector border-1 rounded-5">
                                                            <div class="card-body p-4">
														    	<h5 class="title-forum">📌{{$forum->pinnedPost->title}}</h5>
														    	
                                                                {{$forum->pinnedPost->content}}
														    </div>
													</div>
                                                </a>
												@elseif ($forum->hasPost)
                                                    <div class="card border-1 shadow rounded-3">
                                                        <div class="card-body p-4">
                                                            <a href="/forum/{{$forum->id}}/{{$forum->lastPost->id}}"><h5>{{$forum->lastPost->title}}</h5></a>
                                                            {{$forum->lastPost->content}}
                                                            <a href="{{ route('forum.post', ['id' => $forum->lastPost->id]) }}" class="btn btn-primary">View Post</a>
                                                        </div>
                                                    </div>
                                                @endif
											</div>
										</div>
                                        <div class="mb-2"></div>
									@endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($admin)
    
<div id="modalCreateForum" class="modal fade" tabindex="-1" aria-labelledby="createforum" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('forum.create') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create Forum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <!-- Set a button inside input for emogi keyboard -->
                        <input type="text" class="form-control" id="forumTitle" name="title" placeholder="Forum Title" required>
                        <label for="title" class="form-label">Forum Title</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="category" name="category" placeholder="Forum Category" required>
                        <label for="category" class="form-label">Forum Category</label>
                        <div class="emoji-picker" id="pickerKeyboard" aria-labelledby="popoverEmoji"></div>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input" role="switch" id="upvote" name="upvote" value="1">
                        <label for="upvote" class="form-label">Upvote System</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="admin" name="admin" required>
                            @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}} {{$user->surnames}}</option>
                            @endforeach
                        </select>
                        <label for="Admin" class="form-label">Select an admin</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" id="create" type="submit">Create Forum</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
<!-- Modal for creating a forum -->
@endsection