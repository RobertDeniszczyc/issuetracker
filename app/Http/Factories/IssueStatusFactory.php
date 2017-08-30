<?php

namespace App\Http\Factories;

use App\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Http\Helpers\issueStatusHelper as issueStatusHelper;

class IssueStatusFactory
{
    function __construct() {
        $this->issueStatusHelper = new issueStatusHelper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePaginatedIssueStatuses($issueStatuses, $perPage = 5)
    {
        $issueStatusArray = [];

        if ($issueStatuses) {
            foreach ($issueStatuses as $issueStatus) {

                $issueStatusObject = $this->issueStatusHelper->setIssueStatusMethods($issueStatus);
                
                $issueStatusArray[] = $issueStatusObject;
            }

            $issueStatuses = (object) $issueStatusArray;
            $collection = new Collection($issueStatuses);

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
