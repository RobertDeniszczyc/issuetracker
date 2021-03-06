@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a Project</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('projects.store') }}">
                        {{ csrf_field() }}

                        <input id="user_id" type="hidden" name="user_id" value="{{ Auth::user()->id }}" required>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Project Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('shortcode') ? ' has-error' : '' }}">
                            <label for="shortcode" class="col-md-4 control-label">Shortcode (Max 4 characters)</label>

                            <div class="col-md-6">
                                <input id="shortcode" type="text" class="form-control" name="shortcode" required>

                                @if ($errors->has('shortcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shortcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description (optional)</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description">

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
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
