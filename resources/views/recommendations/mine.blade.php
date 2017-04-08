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
                Recommendations
            </span>

            <div class="btn-group btn-group-xs pull-right" role="group">
                <a href="{{ route('recommendations.recommendation.create') }}" class="btn btn-primary" title="Add Recommendation">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>


        @if(count($recommendations) == 0)
            <div class="panel-body text-center">
                <h4>You haven't recommended anything yet. Would you like to
                  <a href="{{ route('recommendations.recommendation.create') }}"  title="Edit Recommendation">create one?</a></h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Department Id</th>
                            <th>Title</th>
                            <th>Excerpt</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Created At</th>
                            <th>Upc</th>
                            <th>Amazon Link</th>
                            <th>Intent</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($recommendations as $recommendation)
                        <tr>
                            <td>{{ $recommendation->department_id }}</td>
                            <td>{{ $recommendation->title }}</td>
                            <td>{{ $recommendation->excerpt }}</td>
                            <td>{{ $recommendation->image }}</td>
                            <td>{{ $recommendation->status }}</td>
                            <td>{{ $recommendation->featured }}</td>
                            <td>{{ $recommendation->created_at->format('m-d-Y')}}</td>
                            <td>{{ $recommendation->upc }}</td>
                            <td>{{ $recommendation->amazon_link }}</td>
                            <td>{{ $recommendation->intent }}</td>

                            <td>
                                <a href="{{ route('recommendations.recommendation.show', $recommendation->slug ) }}" class="btn btn-success btn-xs" title="View Recommendation">
                                    <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                                </a>
                                @if (Auth::check() && Auth::id() === $recommendation->user->id)
                                <a href="{{ route('recommendations.recommendation.edit', $recommendation->id ) }}" class="btn btn-primary btn-xs" title="Edit Recommendation">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>

                                <form method="POST" action="{!! route('recommendations.recommendation.destroy', $recommendation->id) !!}" accept-charset="UTF-8" style="display: inline;" novalidate="novalidate">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-xs" title="Delete Recommendation" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Recommendation"></span>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $recommendations->render() !!}
        </div>

        @endif

    </div>
@endsection
