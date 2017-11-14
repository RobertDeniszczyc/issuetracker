@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Issue<h1>
                </div>
                <div class="panel-body">
                    <span>{{ $issue->getTitle() }}</span><br>
                    @if ($issue->getDescription())
                        <span>{{ $issue->getDescription() }}</span><br>
                    @endif
                    <span>Created by: {{ $issue->getUser()->getName() }}</span><br>

                    @if ($issue->getUserId() == Auth::user()->id)
                        <a class="btn btn-warning" href="{{ route('issues.edit', ['issue_id' => $issue->getId()]) }}">Edit Issue</a>
                        <form action="{{ route('issues.destroy', ['issue_id' => $issue->getId()]) }}" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button class="btn btn-danger">Destroy Issue</button>
                        </form>
                    @endif
                </div>

            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Comments<h1>
                </div>
                <div class="panel-body">
                    @if (count($comments) > 0)
                        @foreach ($comments as $comment)
                            <div class="panel comment_panel" data-commentid="{{ $comment->getId() }}">
                                {{ $comment->user->getName() }} - Commented at {{ $comment->created_at->format('H:i d-m-Y')}} <br>
                                <span class="comment-content">{{ $comment->getContent() }}</span>

                                @if ($comment->getUserId() == Auth::user()->id)
                                    <a class="btn btn-warning comment--edit">Edit comment</a>
                                @endif

                            </div>
                        @endforeach
                    @else
                        <p>There are no comments on this issue.</p>
                        <br>
                    @endif


                    <form class="form-horizontal" id="comment-add-form" role="form" method="POST" action="{{ route('comments.store') }}">
                        {{ csrf_field() }}

                        <input id="user_id" type="hidden" name="user_id" value="{{ Auth::user()->id }}" required>
                        <input id="issue_id" type="hidden" name="issue_id" value="{{ $issue->getId() }}" required>

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-2 control-label">Comment</label>

                            <div class="col-md-8">
                                <input id="content" type="text" class="form-control" name="content" value="{{ old('content') }}" required autofocus>

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-8">
                                <button type="submit" class="btn btn-primary">
                                    Comment
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Edit comment form !-->
                    <form class="form-horizontal form--edit" id="edit-comment-form" role="form" method="POST" action="{{ route('comments.update', "") }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <input id="user_id" type="hidden" name="user_id" value="{{ Auth::user()->id }}" required>
                        <input id="issue_id" type="hidden" name="issue_id" value="{{ $issue->getId() }}" required>
                        <input id="comment_id" type="hidden" name="comment_id" value="" required>

                        <div class="form-group{{ $errors->has('edited-content') ? ' has-error' : '' }}">
                            <label for="edited-content" class="col-md-2 control-label">Edit Comment</label>

                            <div class="col-md-8">
                                <input id="edited-content" type="text" class="form-control" name="edited_content" value="" required autofocus>

                                @if ($errors->has('edited-content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('edited-content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-8">
                                <button type="submit" class="btn btn-primary" id="comment--submit-edit">
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
