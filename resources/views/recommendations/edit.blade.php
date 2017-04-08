@extends('layouts.app')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <span class="pull-left">
                Recommendation {{ $recommendation->id }}
            </span>

            <div class="btn-group btn-group-xs pull-right" role="group">

                <a href="{{ route('recommendations.recommendation.index') }}" class="btn btn-primary" title="Show all recommendations">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('recommendations.recommendation.create') }}" class="btn btn-primary" title="Add Recommendation">
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

            <form method="POST" action="{{ route('recommendations.recommendation.update', $recommendation->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('recommendations.form', [
                                        'submitButtonLabel' => 'Update', 
                                        'recommendation' => $recommendation,
                                      ])
            </form>

        </div>
    </div>

@endsection