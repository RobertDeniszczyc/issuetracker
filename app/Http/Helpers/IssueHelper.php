<?php

namespace App\Http\Helpers;

use App\Issue;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class IssueHelper
{
    /**
     * Return a collection of all issues.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadIssuesCollection()
    {
        $issues = DB::table('issues')->get();
        $issuesArray = [];

        if ($issues) {
            foreach ($issues as $issue) {

                $issueObject = $this->setIssueMethods($issue);
                
                $issuesArray[] = $issueObject;
            }

            $issues = (object) $issuesArray;
            $collection = new Collection($issues);

            return $collection;
        } else {
            return null;
        }
    }


     /**
     * Set available methods on the object
     *
     * @return \Illuminate\Http\Response
     */
    public function setIssueMethods($issue)
    {
        $issueObject = new Issue;

        if ($issue->id) {
            $issueObject->setId($issue->id);
        }
        if ($issue->user_id) {
            $issueObject->setUserId($issue->user_id);

            $issueObject->setUser(User::find($issue->user_id));
        }
        if ($issue->project_id) {
            $issueObject->setProjectId($issue->project_id);
        }
        if ($issue->title) {
            $issueObject->setTitle($issue->title);
        }
        if ($issue->description) {
            $issueObject->setDescription($issue->description);
        }
        if ($issue->status_id) {
            $issueObject->setStatusId($issue->status_id);
        }
        if ($issue->issue_type_id) {
            $issueObject->setIssueTypeId($issue->issue_type_id);
        }

        return $issueObject;
    }
}
