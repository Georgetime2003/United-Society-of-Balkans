@extends('layout')
@section('header')
<script src="{{ asset('js/reports.js') }}"></script>
@endsection
@section('site_content')
<div class="background">
    <div class="container background-animated">
        <div class="row">
            <div class="col-12">
                <h2 data-header="h1" class="title my-5 fade-up">Forums</h2>
                <div class="row">
                    <div class="card border-1 shadow rounded-3">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="mb-2"></div>
                                <div class="col-12 top-3">
                                    @foreach ($forums as $forum)
										<div class="card border-1 shadow rounded-3">
											<div class="card-body p-4">
												<h4>{{$forum->title}}</h4>
												@if ($forum->hasPostPinned)
													<div class="card border-1 shadow rounded-3">
														<div class="card-body p-4">
															<h5>{{$forum->postPinned->title}}</h5>
															<p>{{$forum->postPinned->content}}</p>
															<a href="{{ route('forum.post', ['id' => $forum->postPinned->id]) }}" class="btn btn-primary">View Post</a>
														</div>
													</div>
												@endif
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
    </div>
</div>
@endsection