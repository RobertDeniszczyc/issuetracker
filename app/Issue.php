<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = [
        'user_id', 'project_id', 'title', 'description', 'status_id', 'issue_type_id'
    ];

    public function setId($id) {
        $this->id = $id;
    }

    public function setUserId($userId) {
        $this->user_id = $userId;
    }

    public function setProjectId($projectId) {
        $this->project_id = $projectId;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setStatusId($statusId) {
        $this->status_id = $statusId;
    }

    public function setIssueTypeId($issueTypeId) {
        $this->issue_type_id = $issueTypeId;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getProjectId() {
        return $this->project_id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getStatusId() {
        return $this->status_id;
    }

    public function getIssueTypeId() {
        return $this->issue_type_id;
    }

    public function getUser() {
        return $this->user;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the comments associated with the issue
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
