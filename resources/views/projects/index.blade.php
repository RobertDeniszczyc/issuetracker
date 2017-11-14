@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Projects<h1>
                    <a href='{{ route('projects.create') }}' class="btn btn-success">Add Project</a>
                </div>

                <div class="panel-body">
                    @if($projects)
                        @foreach ($projects as $project)
                            <span>{{ $project->getName() }}</span><br>
                            @if ($project->getDescription())
                                <span>{{ $project->getDescription() }}</span><br>
                            @endif
                            <span>{{ $project->getShortcode() }}</span>

                            @if ($project->getUserId() == Auth::user()->id)
                                <a class="btn btn-warning" href="{{ route('projects.edit', ['project_id' => $project->getId()]) }}">Edit Project</a>
                                <form action="{{ route('projects.destroy', ['project_id' => $project->getId()]) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger">Destroy Project</button>
                                </form>
                            @endif
                            <hr>
                        @endforeach

                        {{$projects->setPath('projects')->render()}}
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
