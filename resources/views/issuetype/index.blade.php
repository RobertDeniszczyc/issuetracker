@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Issue Types<h1>
                    <a href='{{ route('issuetype.create') }}' class="btn btn-success">Add Issue Type</a>
                </div>

                <div class="panel-body">
                    @if($issueTypes)
                        @foreach ($issueTypes as $issueType)
                            <span>{{ $issueType->getId() }}</span>
                            <span>{{ $issueType->getName() }}</span>
                            <a class="btn btn-warning" href="{{ route('issuetype.edit', ['n' => $issueType->getId()]) }}">Edit Issue Type</a>

                            @if ($issueType->getUserId() == Auth::user()->id)
                                <form action="{{ route('issuetype.destroy', ['project_id' => $issueType->getId()]) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger">Delete Issue Type</button>
                                </form>
                            @else
                                <p><em>Issue Type can only be deleted by its creator</em></p>
                            @endif
                            <hr><br>
                        @endforeach

                        {{ $issueTypes->setPath('issueTypes')->render() }}
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
