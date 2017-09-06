<?php

namespace App\Http\Controllers;

use App\IssueStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Factories\IssueStatusFactory as IssueStatusFactory;

class IssueStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $IssueStatusFactory = new IssueStatusFactory;

        if(DB::table('issue_statuses')->count() > 0) {
            $issueStatuses = $IssueStatusFactory->generatePaginatedIssueStatuses(DB::table('issue_statuses')->get(), 10);
        } else {
            $issueStatuses = null;
        }

        return view('issuestatus.index', ['issueStatuses' => $issueStatuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('issuestatus.create');
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
            'name' => 'required|max:255'
        ]);

        IssueStatus::create($request->all());
        return redirect()->action('HomeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IssueStatus  $issueStatus
     * @return \Illuminate\Http\Response
     */
    public function show(IssueStatus $issueStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IssueStatus  $issueStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(IssueStatus $issueStatus)
    {
        $issueStatus = IssueStatus::where('id', $issueStatus->getId())->first();
        return view('issuestatus.edit', ['issueStatus' => $issueStatus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IssueStatus  $issueStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IssueStatus $issueStatus)
    {
        $this->validate($request, [
                    'name' => 'required|max:255'
                ]);

        $issueStatus->setName($request->name);
        $issueStatus->save();
        
        return redirect()->action('HomeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IssueStatus  $issueStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(IssueStatus $issueStatus)
    {
        $issueStatus = IssueStatus::where('id', $issueStatus->getId())->first();
        $issueStatus->delete();

        return $this->index();
    }
}