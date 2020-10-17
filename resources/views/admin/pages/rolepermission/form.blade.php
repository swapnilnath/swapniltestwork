

<div class="form-group row {{ $errors->has('role_id') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label"><strong>Select Role</strong> <span class="text-danger">*</span></label>
    <div class="col-sm-7">
        {!! Form::text('title',@$roles->role,[
		'class' => 'form-control',
		'id'	=> 'title',
		'maxlength' => '30'
		]) !!}
        <input type="hidden" name="role_id", value="{{@$roles->id}}">
        <span class="help-block">
			<font color="red"> {{ $errors->has('role_id') ? "".$errors->first('role_id')."" : '' }} </font>
		</span>
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">

    <div class="form-group">
        <div class="col-md-12">
            <div class="row">
                <strong class="title">Permission:</strong>
            </div>
        </div>

        <div class="row mt-3">
            @if(\Request::route()->getName() == 'admin.permission.create')
                @foreach($permissions as $value)
                    <div class="col-lg-3 col-md-4 col-sm-3">
                        <div class="custom-control custom-checkbox mb-3">
                            {{ Form::checkbox('permission[]', @$value->id, in_array(@$value->id, $rolePermissions) ? true : false, array('class' => 'name custom-control-input',
                            'id'=>@$value->id
                            )) }}

                            <label class="custom-control-label" for="{{@$value->id}}">{{ @$value->permission }}</label>
                        </div>
                    </div>
                @endforeach

            @else
                @foreach($permissions as $value)
                    <div class="col-lg-3 col-md-4 col-sm-3">
                        <div class="custom-control custom-checkbox mb-3">
                            {!! Form::checkbox('permission[]', @$value->id, false, array('class' => 'name custom-control-input',
                            'id'=>@$value->id
                            )) !!}
                            <label class="custom-control-label" for="{{$value->id}}">{{ $value->permission }}</label>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <span class="help-block">

     <font color="red"> {{ $errors->has('permission') ? "".$errors->first('permission')."" : '' }} </font>

 </span>

</div>



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

    #imagePreview{

        width: 100%;

        height: 100%;

        text-align: center;

        margin:0 auto;

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

</style>

@endsection

