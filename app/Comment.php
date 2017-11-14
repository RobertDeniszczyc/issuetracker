<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'issue_id', 'content'
    ];

    public function setId($id) {
        $this->id = $id;
    }

    public function setUserId($userId) {
        $this->user_id = $userId;
    }

    public function setIssueId($issueId) {
        $this->issue_id = $issue_id;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getIssueId() {
        return $this->issue_id;
    }

    public function getContent() {
        return $this->content;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function issue()
    {
        return $this->belongsTo('App\Issue');
    }
}
