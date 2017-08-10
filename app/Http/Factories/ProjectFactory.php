<?php

namespace App\Http\Factories;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Http\Helpers\ProjectHelper as ProjectHelper;

class ProjectFactory
{
    function __construct() {
        $this->projectHelper = new ProjectHelper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateProjectObject($projects)
    {
        $projectsArray = [];

        if ($projects) {
            foreach ($projects as $project) {

                $projectObject = $this->projectHelper->setProjectMethods($project);
                
                $projectsArray[] = $projectObject;
            }

            $projects = (object) $projectsArray;
            $collection = new Collection($projects);

            $current_page = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 2;
            $currentPageSearchResults = $collection->slice(($current_page * $perPage) - $perPage, $perPage)->all();
            $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);

            return $paginatedSearchResults;
        }
        else {
            return null;
        }
    }
}
