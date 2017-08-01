@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Projects<h1></div>

                <div class="panel-body">
                    @foreach ($projects as $project)
                        <span>{{ $project->getName() }}</span><br>
                        @if ($project->getDescription())
                            <span>{{ $project->getDescription() }}</span><br>
                        @endif
                        <span>{{ $project->getShortcode() }}</span>
                        <hr>
                    @endforeach

                    {{$projects->setPath('projects')->render()}}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
