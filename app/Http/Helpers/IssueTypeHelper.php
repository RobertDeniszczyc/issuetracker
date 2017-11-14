<?php

namespace App\Http\Helpers;

use App\IssueType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class IssueTypeHelper
{
    /**
     * Return a collection of all issue types.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadIssueTypesCollection()
    {
        $issueTypes = DB::table('issue_types')->get();
        $issueTypeArray = [];

        if ($issueTypes) {
            foreach ($issueTypes as $issueType) {

                $issueTypeObject = $this->setIssueTypeMethods($issueType);
                
                $issueTypeArray[] = $issueTypeObject;
            }

            $issueTypes = (object) $issueTypeArray;
            $collection = new Collection($issueTypes);

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
    public function setIssueTypeMethods($issueType)
    {
        $issueTypeObject = new IssueType;

        if ($issueType->id) {
            $issueTypeObject->setId($issueType->id);
        }
        if ($issueType->user_id) {
            $issueTypeObject->setUserId($issueType->user_id);
        }
        if ($issueType->name) {
            $issueTypeObject->setName($issueType->name);
        }

        return $issueTypeObject;
    }
}
