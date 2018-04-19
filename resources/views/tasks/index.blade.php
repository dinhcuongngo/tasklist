@extends('layouts.app')

@section('content')
<section class="body">
	<div class="container">
		<div class="block">
			<div class="block__title">
				<span>New Task</span>
			</div>
			<div class="block__content">
				<form action="/task" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div>
						<label>Task</label>
					</div>
					<div>
						<input type="text" name="name" value="">
					</div>
					<div>
						<button type="submit" name="btnAdd">
							<i class="fas fa-plus"></i> Add new task
						</button>
					</div>
					@if(Session::has('success'))
					<div>
						<p class="msg-success">							
							{{ Session::get('success') }}
					        @php
					        Session::forget('success');
					        @endphp
						</p>
					</div>
					@endif
					<div>
						@include('common.errors')
					</div>
				</form>
			</div>						
		</div>
		<div class="block">
			<div class="block__title">
				<span>Current Tasks</span>
			</div>
			<div class="block__content">
				<p class="block__content_top">Task</p>
				@if(isset($tasks))
					@foreach($tasks as $task)
						<div class="block__content_list clearfix">
							<div class="block__content_list_left">
								<span>{{ $task->name }}</span>
							</div>
							<div class="block__content_list_right">
								<a href="/tasks/{{ $task->id }}" class="btn btnUpdate">Update</a>
								<form action="/tasks/{{ $task->id }}" method="POST">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="_method" value="DELETE">
									<button type="submit" class="btn btnDel">Delete</button>
								</form>
							</div>
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>
</section>
@endsection