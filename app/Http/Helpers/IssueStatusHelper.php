<?php

namespace App\Http\Helpers;

use App\IssueStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class IssueStatusHelper
{
    /**
     * Return a collection of all issue statuses.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadIssueStatusesCollection()
    {
        $issueStatuses = DB::table('issue_statuses')->get();
        $issueStatusArray = [];

        if ($issueStatuses) {
            foreach ($issueStatuses as $issueStatus) {

                $issueStatusObject = $this->setIssueStatusMethods($issueStatus);
                
                $issueStatusArray[] = $issueStatusObject;
            }

            $issueStatuses = (object) $issueStatusArray;
            $collection = new Collection($issueStatuses);

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
    public function setIssueStatusMethods($issueStatus)
    {
        $issueStatusObject = new IssueStatus;

        if ($issueStatus->id) {
            $issueStatusObject->setId($issueStatus->id);
        }
        if ($issueStatus->name) {
            $issueStatusObject->setName($issueStatus->name);
        }

        return $issueStatusObject;
    }
}
