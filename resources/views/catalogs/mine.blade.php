@extends('layouts.app')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <span class="pull-left">
                Catalogs
            </span>

            <div class="btn-group btn-group-xs pull-right" role="group">

                <a href="{{ route('catalogs.catalog.create') }}" class="btn btn-primary" title="Add Catalog">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>

            </div>

        </div>

        @if(count($catalogs) == 0)
            <div class="panel-body text-center">
                <h4>There are no records!</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Catalog Type</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($catalogs as $catalog)
                        <tr>
                            <td>{{ $catalog->user_id }}</td>
                            <td>{{ $catalog->title }}</td>
                            <td>{{ $catalog->description }}</td>
                            <td>{{ $catalog->image }}</td>
                            <td>{{ $catalog->status }}</td>
                            <td>{{ $catalog->created_at }}</td>
                            <td>{{ $catalog->updated_at }}</td>
                            <td>{{ $catalog->catalog_type }}</td>

                            <td>
                                <a href="{{ route('catalogs.catalog.show', $catalog->id ) }}" class="btn btn-success btn-xs" title="View Catalog">
                                    <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                                </a>
                                <a href="{{ route('catalogs.catalog.edit', $catalog->id ) }}" class="btn btn-primary btn-xs" title="Edit Catalog">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                                {!! Form::open([
                                    'method' =>'DELETE',
                                    'route'  => ['catalogs.catalog.destroy', $catalog->id],
                                    'style'  => 'display: inline;',
                                ]) !!}
                                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Catalog"></span>',
                                        [
                                            'type'    => 'submit',
                                            'class'   => 'btn btn-danger btn-xs',
                                            'title'   => 'Delete Catalog',
                                            'onclick' => 'return confirm("Confirm delete?")'
                                        ])
                                    !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>

        <div class="panel-footer">
            {!! $catalogs->render() !!}
        </div>

        @endif

    </div>
@endsection
