


<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title','Title',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('title',null, ['class' => 'form-control', 'maxlength' => '255',]) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description','Description',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::textarea('description', null, ['class' => 'form-control', 'maxlength' => '65535',]) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image','Image',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        <label class="btn btn-default">
        	Browse <input type="file" name="image" id="image" class="hidden">
        </label>

        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status','Status',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('status',['PUBLISHED' => 'PUBLISHED', 'DRAFT' => 'DRAFT', 'PENDING' => 'PENDING'],null, ['class' => 'form-control',]) !!}
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>









<div class="form-group {{ $errors->has('catalog_type') ? 'has-error' : ''}}">
    {!! Form::label('catalog_type','Catalog Type',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('catalog_type',['Purchase' => 'Purchase', 'Recommend' => 'Recommend', 'Avoid' => 'Avoid'],null, ['class' => 'form-control',]) !!}
        {!! $errors->first('catalog_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-2 col-md-10">
        {!! Form::submit(isset($submitButtonLabel) ? $submitButtonLabel : 'Add', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
