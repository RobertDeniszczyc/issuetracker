<?php

namespace App\Http\Controllers;

use App\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Factories\ProjectFactory as ProjectFactory;
use App\Http\Helpers\ProjectHelper as ProjectHelper;
use App\Http\Helpers\IssueTypeHelper as IssueTypeHelper;
use App\Http\Helpers\IssueStatusHelper as IssueStatusHelper;

class IssueController extends Controller
{

    function __construct() {
        $this->projectFactory = new ProjectFactory;
        $this->projectHelper = new ProjectHelper;
        $this->issueTypeHelper = new IssueTypeHelper;
        $this->issueStatusHelper = new IssueStatusHelper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = $this->projectHelper->loadProjectsCollection();
        $issueStatuses = $this->issueStatusHelper->loadIssueStatusesCollection();
        $issueTypes = $this->issueTypeHelper->loadIssueTypesCollection();

        return view('issues.create', ['projects' => $projects,
                                      'issueStatuses' => $issueStatuses,
                                      'issueTypes' => $issueTypes]);
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
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status_id' => 'required',
            'issue_type_id' => 'required',
            'project_id' => 'required'
        ]);

        Issue::create($request->all());
        return redirect()->action('HomeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issue $issue)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {

    }
}
