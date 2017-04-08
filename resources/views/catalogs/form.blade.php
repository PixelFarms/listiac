
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id','User Id',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('user_id',null, ['class' => 'form-control',]) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

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

<div class="form-group {{ $errors->has('longitude') ? 'has-error' : ''}}">
    {!! Form::label('longitude','Longitude',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('longitude',null, ['class' => 'form-control', 'maxlength' => '25',]) !!}
        {!! $errors->first('longitude', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('latitude') ? 'has-error' : ''}}">
    {!! Form::label('latitude','Latitude',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('latitude',null, ['class' => 'form-control', 'maxlength' => '25',]) !!}
        {!! $errors->first('latitude', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('address1') ? 'has-error' : ''}}">
    {!! Form::label('address1','Address1',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('address1',null, ['class' => 'form-control', 'maxlength' => '125',]) !!}
        {!! $errors->first('address1', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('address2') ? 'has-error' : ''}}">
    {!! Form::label('address2','Address2',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('address2',null, ['class' => 'form-control', 'maxlength' => '125',]) !!}
        {!! $errors->first('address2', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
    {!! Form::label('city','City',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('city',null, ['class' => 'form-control', 'maxlength' => '125',]) !!}
        {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
    {!! Form::label('state','State',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('state',null, ['class' => 'form-control', 'maxlength' => '125',]) !!}
        {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('country') ? 'has-error' : ''}}">
    {!! Form::label('country','Country',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('country',null, ['class' => 'form-control', 'maxlength' => '225',]) !!}
        {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('zipcode') ? 'has-error' : ''}}">
    {!! Form::label('zipcode','Zipcode',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('zipcode',null, ['class' => 'form-control', 'maxlength' => '25',]) !!}
        {!! $errors->first('zipcode', '<p class="help-block">:message</p>') !!}
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