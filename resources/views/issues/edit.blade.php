@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit an Issue</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('issues.update', $issue->getId()) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <input id="user_id" type="hidden" name="user_id" value="{{ Auth::user()->id }}" required>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $issue->getTitle() }}" required autofocus>

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
                                <input id="description" type="description" class="form-control" value="{{ $issue->getDescription() }}" name="description">

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
                                  @if ($issue->getProjectId())
                                        @foreach ($projects as $project)
                                            @if ($project->getId() == $issue->getProjectId())
                                                <option value="{{ $project->getId() }}" selected="selected">{{ $project->getName() }}</option>
                                            @else
                                                <option value="{{ $project->getId() }}">{{ $project->getName() }}</option>
                                            @endif
                                        @endforeach
                                  @else
                                      @foreach ($projects as $project)
                                        <option value="{{ $project->getId() }}">{{ $project->getName() }}</option>
                                      @endforeach
                                  @endif
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
                                @if ($issue->getStatusId())
                                    @foreach ($issueStatuses as $status)
                                        @if ($status->getId() == $issue->getStatusId())
                                            <option value="{{ $status->getId() }}" selected="selected">{{ $status->getName() }}</option>
                                        @else
                                            <option value="{{ $status->getId() }}">{{ $status->getName() }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($issueStatuses as $status)
                                        <option value="{{ $status->getId() }}">{{ $status->getName() }}</option>
                                    @endforeach
                                @endif
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

                                @if ($issue->getIssueTypeId())
                                    @foreach ($issueTypes as $issueType)
                                        @if ($issueType->getId() == $issue->getIssueTypeId())
                                            <option value="{{ $issueType->getId() }}" selected="selected">{{ $issueType->getName() }}</option>
                                        @else
                                            <option value="{{ $issueType->getId() }}">{{ $issueType->getName() }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($issueTypes as $issueType)
                                        <option value="{{ $issueType->getId() }}">{{ $issueType->getName() }}</option>
                                    @endforeach
                                @endif
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
                                    Submit
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
