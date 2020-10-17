
<div class="form-group  row {{ $errors->has('title') ? 'has-error' : '' }}"><label class="col-sm-3 col-form-label"><strong>Title</strong> <span class="text-danger">*</span></label>
	<div class="col-sm-9">{!! Form::text('title',@$post->title,[
		'class' => 'form-control',
		'id'	=> 'title',
		'maxlength' => '30'
		]) !!}
		<span class="help-block">
			<font color="red"> {{ $errors->has('title') ? "".$errors->first('page_title')."" : '' }} </font>
		</span>
	</div>
</div>

<div class="form-group row {{ $errors->has('description') ? 'has-error' : '' }}"><label class="col-sm-3 col-form-label"><strong>Description</strong> <span class="text-danger">*</span></label>
	<div class="col-sm-9">{!! Form::textarea('description',@$post->description,[
		'class' => 'form-control ',
		'id'	=> 'description'
		]) !!}
		<span class="help-block">
			<font color="red"> {{ $errors->has('description') ? "".$errors->first('description')."" : '' }} </font>
		</span>
	</div>
</div>

<div class="form-group row {{ $errors->has('user_id') ? 'has-error' : '' }}"><label class="col-sm-3 col-form-label"><strong>Select User</strong> <span class="text-danger">*</span></label>
	<div class="col-sm-7">
		{!! Form::select('user_id',$users,@$post->user_id,[
        'class'         => 'form-control',
        'id'            => 'user_id',
        'placeholder'   => 'Please select User'
        ]) !!}
		<span class="help-block">
			<font color="red"> {{ $errors->has('user_id') ? "".$errors->first('user_id')."" : '' }} </font>
		</span>
	</div>
</div>

<div class="form-group row {{ $errors->has('image') ? 'has-error' : '' }}">
	<label class="col-sm-3 col-form-label"><strong>Upload Image</strong> <span class="text-danger">*</span></label>
	<div class="col-sm-7">
		<input type="file" class="form-control" name="image" id="image">
		<span class="help-block">
			<font color="red"> {{ $errors->has('image') ? "".$errors->first('image')."" : '' }} </font>
		</span>

		@if(@$post->image)
			<img height="50px" width="50px" src = "{{ asset('storage/posts/').'/'.$post->image  }}" alt = "user" class="rounded-circle">
		@endif
	</div>
</div>




<div class="hr-line-dashed"></div>
@section('styles')
<style type="text/css">
	.help-block {
		display: inline-block;
		margin-top: 5px;
		margin-bottom: 0px;
		margin-left: 5px;
	}
	.form-group {
		margin-bottom: 10px;
	}
	.form-control {
		font-size: 14px;
		font-weight: 500;
	}
	#imagePreview {
		width: 135px;
		height: 100%;
		text-align: center;
		margin: 0 auto;
		position: relative;
	}
	#hidden{
		display: none !important;
	}
	#imagePreview img {
		height: 150px;
		width: 150px;
		border: 3px solid rgba(0,0,0,0.4);
		padding: 3px;
	}
	#imagePreview i{
		position: absolute;
		right: 0px;
		background: rgba(0,0,0,0.5);
		padding: 5px;
		border-radius: 50%;
		width: 30px;
		height: 30px;
		color: #fff;
		font-size: 18px;
	}
</style>
@endsection
@section('scripts')
<script>
	$(document).ready(function () {
		$('#page_title').on('keyup onmouseout keydown keypress blur change', function (event) {
			var regex = new RegExp("^[a-zA-Z ._\\b]+$");
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
				event.preventDefault();
				return false;
			}
		});
	});
</script>
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
	var editor = CKEDITOR.replace( 'description', {
		language: 'en',
		toolbar :
		[
		{ name: 'document', items : [ 'NewPage','Preview' ] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
		{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'
		,'Iframe' ] },
		'/',
		{ name: 'styles', items : [ 'Styles','Format' ] },
		{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'tools', items : [ 'Maximize','-','About' ] }
		],
		extraPlugins: 'notification'
	});

	editor.on( 'required', function( evt ) {
		editor.showNotification( 'This field is required.', 'warning' );
		evt.cancel();
	} );

</script>


@endsection

