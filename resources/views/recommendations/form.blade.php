

@if (Config::get('recommendations.showCategory'))
<div class="form-group {{ $errors->has('department_id') ? 'has-error' : ''}}">
    <label for="department_id" class="col-md-2 control-label">Department Id</label>
    <div class="col-md-10">
{{ Form::select('id', $departments, null, ['class' => 'form-control']) }}

        {!! $errors->first('department_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@endif

<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="col-md-2 control-label">Title</label>
    <div class="col-md-10">
        <input class="form-control" name="title" type="text" id="title" value="{{ old('title', isset($recommendation) ? $recommendation->title : null) }}" maxlength="255" placeholder="Title">
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
    <label for="body" class="col-md-2 control-label">Body</label>
    <div class="col-md-10">
        <textarea class="form-control" name="body" cols="50" rows="10" id="body" maxlength="65535">{{ old('body', isset($recommendation) ? $recommendation->body : null) }}</textarea>
        {!! $errors->first('body', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="col-md-2 control-label">Image</label>
    <div class="col-md-10">
        <label class="btn btn-default">
        	Browse <input type="file" name="image" id="image" class="hidden">
        </label>

        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('catalog_id') ? 'has-error' : ''}}">
    <label for="catalog_id" class="col-md-2 control-label">Catalog Id</label>
    <div class="col-md-10">
{{ Form::select('id', $catalogs, null, ['class' => 'form-control']) }}

        {!! $errors->first('catalog_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-2 control-label">Status</label>
    <div class="col-md-10">
        <select class="form-control" id="status" name="status" >

        	@foreach (['PUBLISHED' => 'PUBLISHED',
'DRAFT' => 'DRAFT',
'PENDING' => 'PENDING'] as $value => $title)
			    <option value="{{ $value }}" {{ old('status', isset($recommendation) ? $recommendation->status : '') == $value ? 'selected' : '' }}>
			    	{{ $title }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<div class="form-group {{ $errors->has('upc') ? 'has-error' : ''}}">
    <label for="upc" class="col-md-2 control-label">Upc</label>
    <div class="col-md-10">
        <input class="form-control" name="upc" type="text" id="upc" value="{{ old('upc', isset($recommendation) ? $recommendation->upc : null) }}" maxlength="125">
        {!! $errors->first('upc', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('amazon_link') ? 'has-error' : ''}}">
    <label for="amazon_link" class="col-md-2 control-label">Amazon Link</label>
    <div class="col-md-10">
        <input class="form-control" name="amazon_link" type="text" id="amazon_link" value="{{ old('amazon_link', isset($recommendation) ? $recommendation->amazon_link : null) }}" maxlength="125">
        {!! $errors->first('amazon_link', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('intent') ? 'has-error' : ''}}">
    <label for="intent" class="col-md-2 control-label">Intent</label>
    <div class="col-md-10">
        <select class="form-control" id="intent" name="intent" >

        	@foreach (['WANT' => 'WANT',
'LOVE' => 'LOVE',
'HATE' => 'HATE'] as $value => $title)
			    <option value="{{ $value }}" {{ old('intent', isset($recommendation) ? $recommendation->intent : '') == $value ? 'selected' : '' }}>
			    	{{ $title }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('intent', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-2 col-md-10">
        <input class="btn btn-primary" type="submit" value="{{ isset($submitButtonLabel) ? $submitButtonLabel : 'Add' }}">
    </div>
</div>
