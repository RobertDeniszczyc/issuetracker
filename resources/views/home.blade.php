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

                <a href='{{ route('projects.create') }}' class="btn btn-info">Add Project</a>
                <a class="btn btn-success">Add Issue</a>
            </div>
        </div>
    </div>
</div>
@endsection
