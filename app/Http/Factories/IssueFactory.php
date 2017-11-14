<?php

namespace App\Http\Factories;

use App\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Http\Helpers\IssueHelper as IssueHelper;

class IssueFactory
{
    function __construct() {
        $this->issueHelper = new IssueHelper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePaginatedIssues($issues, $perPage = 5)
    {
        $issuesArray = [];

        if ($issues) {
            foreach ($issues as $issue) {

                $issueObject = $this->issueHelper->setIssueMethods($issue);
                
                $issuesArray[] = $issueObject;
            }

            $issues = (object) $issuesArray;
            $collection = new Collection($issues);

            $current_page = LengthAwarePaginator::resolveCurrentPage();
            $perPage = $perPage;
            $currentPageSearchResults = $collection->slice(($current_page * $perPage) - $perPage, $perPage)->all();
            $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);

            return $paginatedSearchResults;
        }
        else {
            return null;
        }
    }
}
