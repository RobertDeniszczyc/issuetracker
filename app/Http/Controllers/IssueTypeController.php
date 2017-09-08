<?php

namespace App\Http\Controllers;

use App\IssueType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Factories\IssueTypeFactory as IssueTypeFactory;

class IssueTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $IssueTypeFactory = new IssueTypeFactory;

        if(DB::table('issue_types')->count() > 0) {
            $issueTypes = $IssueTypeFactory->generatePaginatedIssueTypes(DB::table('issue_types')->get(), 10);
        } else {
            $issueTypes = null;
        }

        return view('issuetype.index', ['issueTypes' => $issueTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('issuetype.create');
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

        IssueType::create($request->all());
        return redirect()->action('IssueTypeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IssueType  $issueType
     * @return \Illuminate\Http\Response
     */
    public function show(IssueType $issueType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IssueType  $issueType
     * @return \Illuminate\Http\Response
     */
    public function edit(IssueType $issueType)
    {
        $issueType = IssueType::where('id', $issueType->getId())->first();
        return view('issuetype.edit', ['issueType' => $issueType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IssueType  $issueType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IssueType $issueType)
    {
        $this->validate($request, [
                    'name' => 'required|max:255'
                ]);

        $issueType->setName($request->name);
        $issueType->save();
        
        return redirect()->action('IssueTypeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IssueType  $issueType
     * @return \Illuminate\Http\Response
     */
    public function destroy(IssueType $issueType)
    {
        $issueType = IssueType::where('id', $issueType->getId())->first();
        $issueType->delete();

        return redirect()->action('IssueTypeController@index');
    }
}