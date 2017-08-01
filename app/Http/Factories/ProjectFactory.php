<?php

namespace App\Http\Factories;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProjectFactory
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateProjectObject($projects)
    {
        $projectsArray = [];
        foreach ($projects as $project) {
            $projectObject = new Project;

            if ($project->id) {
                $projectObject->setId($project->id);
            }
            if ($project->name) {
                $projectObject->setName($project->name);
            }
            if ($project->description) {
                $projectObject->setDescription($project->description);
            }
            if ($project->shortcode) {
                $projectObject->setShortcode($project->shortcode);
            }
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
}
