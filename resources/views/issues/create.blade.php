@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create an Issue</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('issues.store') }}">
                        {{ csrf_field() }}

                        <input id="user_id" type="hidden" name="user_id" value="{{ Auth::user()->id }}" required>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description (optional)</label>

                            <div class="col-md-6">
                                <input id="description" type="description" class="form-control" name="description">

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('project_id') ? ' has-error' : '' }}">
                            <label for="project_id" class="col-md-4 control-label">Project</label>

                            <div class="col-md-6">
                                <select id="project_id" name="project_id">
                                  @foreach ($projects as $project)
                                    <option value="{{ $project->getId() }}">{{ $project->getName() }}</option>
                                  @endforeach
                                </select>

                                @if ($errors->has('project_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('project_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }}">
                            <label for="status_id" class="col-md-4 control-label">Status</label>

                            <div class="col-md-6">
                                <select id="status_id" name="status_id">
                                  @foreach ($statuses as $status)
                                    <option value="{{ $status->getId() }}">{{ $status->getName() }}</option>
                                  @endforeach
                                </select>

                                @if ($errors->has('status_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('issue_type_id') ? ' has-error' : '' }}">
                            <label for="issue_type_id" class="col-md-4 control-label">Issue Type</label>

                            <div class="col-md-6">
                                <select id="issue_type_id" name="issue_type_id">
                                  @foreach ($issueTypes as $issueType)
                                    <option value="{{ $issueType->getId() }}">{{ $issueType->getName() }}</option>
                                  @endforeach
                                </select>

                                @if ($errors->has('issue_type_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('issue_type_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create Issue
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
