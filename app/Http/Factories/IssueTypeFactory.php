<?php

namespace App\Http\Factories;

use App\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Http\Helpers\IssueTypeHelper as IssueTypeHelper;

class IssueTypeFactory
{
    function __construct() {
        $this->IssueTypeHelper = new IssueTypeHelper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePaginatedIssueTypes($issueTypes, $perPage = 5)
    {
        $issueTypeArray = [];

        if ($issueTypes) {
            foreach ($issueTypes as $issueType) {

                $issueTypeObject = $this->IssueTypeHelper->setIssueTypeMethods($issueType);
                
                $issueTypeArray[] = $issueTypeObject;
            }

            $issueTypes = (object) $issueTypeArray;
            $collection = new Collection($issueTypes);

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
