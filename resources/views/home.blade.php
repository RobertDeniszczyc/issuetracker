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
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Issues</div>
                <a class="btn btn-success">Add Issue</a>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Projects</div>
                <a href='{{ route('projects.index') }}' class="btn btn-info">View all projects</a>
                <a href='{{ route('projects.create') }}' class="btn btn-success">Add Project</a>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Issue Management</div>
                <a href='{{ route('issuestatus.create') }}' class="btn btn-success">Create Issue Status</a>
                <a href='{{ route('issuetype.create') }}' class="btn btn-success">Create Issue Type</a>
            </div>
        </div>
    </div>
</div>
@endsection
