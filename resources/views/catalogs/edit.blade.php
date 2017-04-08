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

                <a href="{{ route('catalogs.catalog.create') }}" class="btn btn-primary" title="Add Catalog">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>

            </div>
        </div>

        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            {!! Form::model($catalog, [
                'method' => 'PUT',
                'route' => ['catalogs.catalog.update', $catalog->id],
                'class' => 'form-horizontal',
                'files' => true,
            ]) !!}

            @include ('catalogs.form', [
                                        'submitButtonLabel' => 'Update', 
                                        'catalog' => $catalog,
                                      ])

            {!! Form::close() !!}

        </div>
    </div>

@endsection