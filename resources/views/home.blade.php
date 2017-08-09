@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>

                <a class="btn btn-success">Add Issue</a>
                <hr>
                <a href='{{ route('projects.index') }}' class="btn btn-info">View all projects</a>
                <a href='{{ route('projects.create') }}' class="btn btn-success">Add Project</a>
                <hr>
                <a href='{{ route('issuestatus.create') }}' class="btn btn-success">Create Issue Status</a>
            </div>
        </div>
    </div>
</div>
@endsection
