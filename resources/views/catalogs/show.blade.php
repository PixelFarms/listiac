@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            Catalog {{ $catalog->id }}
        </span>

        <div class="btn-group btn-group-xs pull-right" role="group">


            <a href="{{ route('catalogs.catalog.index') }}" class="btn btn-primary" title="Show all catalogs">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('catalogs.catalog.edit', $catalog->id ) }}" class="btn btn-primary" title="Edit Catalog">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </a>

            {!! Form::open([
                'method' =>'DELETE',
                'route'  => ['catalogs.catalog.destroy', $catalog->id],
                'style' => 'display: inline;',
            ]) !!}
                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Catalog"></span>', 
                    [   
                        'type'    => 'submit',
                        'class'   => 'btn btn-danger btn-xs',
                        'title'   => 'Delete Catalog',
                        'onclick' => 'return confirm("Confirm delete?")',
                    ])
                !!}
            {!! Form::close() !!}

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>User Id</dt>
            <dd>{{ $catalog->user_id }}</dd>
            <dt>Title</dt>
            <dd>{{ $catalog->title }}</dd>
            <dt>Description</dt>
            <dd>{{ $catalog->description }}</dd>
            <dt>Image</dt>
            <dd>{{ $catalog->image }}</dd>
            <dt>Status</dt>
            <dd>{{ $catalog->status }}</dd>
            <dt>Longitude</dt>
            <dd>{{ $catalog->longitude }}</dd>
            <dt>Latitude</dt>
            <dd>{{ $catalog->latitude }}</dd>
            <dt>Address1</dt>
            <dd>{{ $catalog->address1 }}</dd>
            <dt>Address2</dt>
            <dd>{{ $catalog->address2 }}</dd>
            <dt>City</dt>
            <dd>{{ $catalog->city }}</dd>
            <dt>State</dt>
            <dd>{{ $catalog->state }}</dd>
            <dt>Country</dt>
            <dd>{{ $catalog->country }}</dd>
            <dt>Zipcode</dt>
            <dd>{{ $catalog->zipcode }}</dd>
            <dt>Created At</dt>
            <dd>{{ $catalog->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $catalog->updated_at }}</dd>
            <dt>Catalog Type</dt>
            <dd>{{ $catalog->catalog_type }}</dd>

        </dl>

    </div>
</div>

@endsection