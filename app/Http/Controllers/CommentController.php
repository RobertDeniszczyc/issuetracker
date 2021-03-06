<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Issue;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'issue_id' => 'required',
            'content' => 'required'
        ]);

        $issue = Issue::where('id', $request->issue_id)->first();

        Comment::create($request->all());

        return redirect()->action('IssueController@show', $issue);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'issue_id' => 'required',
            'edited_content' => 'required'
        ]);

        $comment = Comment::where('id', $id)->first();
        $issue = Issue::where('id', $request->issue_id)->first();

        if ($request->user_id == $comment->getUserId()) {
            $comment->setContent($request->edited_content);
            $comment->save();

            return redirect()->action('IssueController@show', $issue);
        } else {
            error_log("Error updating comment. Request user id does not match comment owner user id");
            return redirect()->action('IssueController@show', $issue);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
