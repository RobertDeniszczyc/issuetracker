<?php

namespace App\Http\Helpers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProjectHelper
{
    /**
     * Return a collection of all projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadProjectsCollection()
    {
        $projects = DB::table('projects')->get();
        $projectsArray = [];

        if ($projects) {
            foreach ($projects as $project) {

                $projectObject = $this->setProjectMethods($project);
                
                $projectsArray[] = $projectObject;
            }

            $projects = (object) $projectsArray;
            $collection = new Collection($projects);

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
    public function setProjectMethods($project)
    {
        $projectObject = new Project;

        if ($project->id) {
            $projectObject->setId($project->id);
        }
        if ($project->user_id) {
            $projectObject->setUserId($project->user_id);
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

        return $projectObject;
    }
}
