@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Issues<h1>
                    <a href='{{ route('issues.create') }}' class="btn btn-success">Add Issue</a>
                </div>

                <div class="panel-body">
                    @if($issues)
                        @foreach ($issues as $issue)
                            <span><a href="{{ route('issues.show', $issue->getId()) }}">{{ $issue->getTitle() }}</a></span><br>
                            @if ($issue->getDescription())
                                <span>{{ $issue->getDescription() }}</span><br>
                            @endif
                            <span>Created by: {{ $issue->getUser()->getName() }}</span><br>
                            <a class="btn btn-warning" href="{{ route('issues.edit', ['issue_id' => $issue->getId()]) }}">Edit Issue</a>

                            @if ($issue->getUserId() == Auth::user()->id)
                                <form action="{{ route('issues.destroy', ['issue_id' => $issue->getId()]) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger">Destroy Issue</button>
                                </form>
                            @else
                                <a class="btn btn-danger" disabled>Destroy Issue</a>
                            @endif
                            <hr>
                        @endforeach

                        {{ $issues->setPath('issues')->render() }}
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
