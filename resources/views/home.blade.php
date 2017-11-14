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
                <div class="panel-body">
                    <a href='{{ route('issues.index') }}' class="btn btn-info">View all Issues</a>
                    <a href='{{ route('issues.create') }}' class="btn btn-success">Add Issue</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Projects</div>
                <div class="panel-body">
                    <a href='{{ route('projects.index') }}' class="btn btn-info">View all projects</a>
                    <a href='{{ route('projects.create') }}' class="btn btn-success">Add Project</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Issue Statuses</div>
                <div class="panel-body">
                    <a href='{{ route('issue-status.index') }}' class="btn btn-info">View Issue Statuses</a>
                    <a href='{{ route('issue-status.create') }}' class="btn btn-success">Create Issue Status</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Issue Types</div>
                <div class="panel-body">
                    <a href='{{ route('issue-type.index') }}' class="btn btn-info">View Issue Types</a> 
                    <a href='{{ route('issue-type.create') }}' class="btn btn-success">Create Issue Type</a>
                </div>                    
            </div>
        </div>
    </div>
</div>
@endsection
