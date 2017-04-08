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

            <a href="{{ route('recommendations.recommendation.edit', $recommendation->id ) }}" class="btn btn-primary" title="Edit Recommendation">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </a>

            <form method="POST" action="{!! route('recommendations.recommendation.destroy', $recommendation->id) !!}" accept-charset="UTF-8" style="display: inline;" novalidate="novalidate">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-xs" title="Delete Recommendation" onclick="return confirm(&quot;Confirm delete?&quot;)" id="sometest">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Recommendation"></span>
                </button>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Department Id</dt>
            <dd>{{ $recommendation->department_id }}</dd>
            <dt>Title</dt>
            <dd>{{ $recommendation->title }}</dd>
            <dt>Excerpt</dt>
            <dd>{{ $recommendation->excerpt }}</dd>
            <dt>Body</dt>
            <dd>{{ $recommendation->body }}</dd>
            <dt>Image</dt>
            <dd>{{ asset($recommendation->image) }}</dd>
            <dt>Status</dt>
            <dd>{{ $recommendation->status }}</dd>
            <dt>Featured</dt>
            <dd>{{ $recommendation->featured }}</dd>
            <dt>Created At</dt>
            <dd>{{ $recommendation->created_at }}</dd>
            <dt>Upc</dt>
            <dd>{{ $recommendation->upc }}</dd>
            <dt>Amazon Link</dt>
            <dd>{{ $recommendation->amazon_link }}</dd>
            <dt>Intent</dt>
            <dd>{{ $recommendation->intent }}</dd>

        </dl>

    </div>
</div>

@endsection
