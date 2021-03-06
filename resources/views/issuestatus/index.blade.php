@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Issue Status<h1>
                    <a href='{{ route('issue-status.create') }}' class="btn btn-success">Add Issue Status</a>
                </div>

                <div class="panel-body">
                    @if($issueStatuses)
                        @foreach ($issueStatuses as $issueStatus)
                            <span><strong>{{ $issueStatus->getName() }}</strong></span>

                            @if ($issueStatus->getUserId() == Auth::user()->id)
                                <a class="btn btn-warning" href="{{ route('issue-status.edit', ['n' => $issueStatus->getId()]) }}">Edit Issue Status</a>
                                <form action="{{ route('issue-status.destroy', ['project_id' => $issueStatus->getId()]) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger">Delete Issue Status</button>
                                </form>
                            @else
                                <p><em>Issue Status can only be edited and deleted by its creator</em></p>
                            @endif
                            <hr><br>
                        @endforeach

                        {{ $issueStatuses->setPath('issueStatuses')->render() }}
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
