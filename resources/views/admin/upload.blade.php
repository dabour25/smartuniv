<form action="/upload/editor" method="post" enctype="multipart/form-data" id="send">
	{{ csrf_field() }}
	<label>Upload Image</label>
	<br>
	<input name="img" type="file" id="file">
</form>
<p>Uploaded Image URL to Paste it in Editor:</p>
<p>{{$url}}</p>
<script type="text/javascript">
	document.getElementById("file").onchange = function() {
	    document.getElementById("send").submit();
	};
</script>