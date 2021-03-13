<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{$page_title}}</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<div class="row" style="padding: 20px;">
		<div class="col-md-6">
			<h1>New Blog</h1>
			<form action="" method="POST" enctype="multipart/form-data">
				@if(session()->has('notification-status'))
				<div class="alert alert-{{in_array(session()->get('notification-status'),['failed','error','danger']) ? 'danger' : session()->get('notification-status')}}" role="alert">
				{{session()->get('notification-msg')}}
				</div>
				@endif
				{!!csrf_field()!!}
				<div class="form-group">
					<label for="">Blog Thumbnail</label>
					<input type="file" class="form-control" name="image" accept="image/*">
					@if($errors->first('image'))
					<p class="mt-1 text-danger">{!!$errors->first('image')!!}</p>
					@endif
				</div>

				<div class="form-group">
					<label for="">Blog Title</label>
					<input type="text" class="form-control" name="title" value="{{old('title')}}">
					@if($errors->first('title'))
					<p class="mt-1 text-danger">{!!$errors->first('title')!!}</p>
					@endif
				</div>

				<div class="form-group">
					<label for="">Content</label>
					<textarea name="content" id="" cols="30" rows="10" class="form-control">{!!old('content')!!}</textarea>
					@if($errors->first('content'))
					<p class="mt-1 text-danger">{!!$errors->first('content')!!}</p>
					@endif
				</div>

				<div class="btn-group">
					<button class="btn btn-success" type="submit">Submit</button>
					<a href="{{route('frontend.blog.index')}}" class="btn btn-default">Cancel</a>
				</div>
			</form>
		</div>
	</div>
</body>
</html>