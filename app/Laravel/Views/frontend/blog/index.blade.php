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
		<div class="col-md-8">
			<h1>List of Blog</h1>
			<a href="{{route("frontend.blog.create")}}" class="btn btn-primary">Add Blog</a>
			@if(session()->has('notification-status'))
			<div class="alert alert-{{in_array(session()->get('notification-status'),['failed','error','danger']) ? 'danger' : session()->get('notification-status')}}" role="alert">
			{{session()->get('notification-msg')}}
			</div>
			@endif
			<table class="table table-bordered table-condensed table-striped table-hover">
			  <thead>
			    <tr>
			      <th class="text-center" scope="col">#</th>
			      <th scope="col">Title</th>
			      <th scope="col">Content</th>
			      <th scope="col">Actions</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach($blogs as $index => $blog)
			    <tr class="blog">
			    	<td>{{$blog->id}}</td>
			    	<td>{{$blog->title}}</td>
			    	<td>{{$blog->content}}</td>
			    	<td><div class="btn-group">
			    		<a href="{{route('frontend.blog.edit',[$blog->id])}}" class="btn btn-secondary btn-sm">Update Blog</a>
			    		<a href="{{route('frontend.blog.destroy',[$blog->id])}}" class="btn btn-danger btn-sm">Remove Blog</a>
			    	</div></td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>
		</div>
	</div>
	
</body>
</html>