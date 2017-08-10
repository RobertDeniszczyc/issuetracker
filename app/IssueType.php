<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueType extends Model
{
    protected $fillable = [
        'user_id', 'name'
    ];

    public function setId($id) {
        $this->id = $id;
    }

    public function setUserId($userId) {
        $this->user_id = $userId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getName() {
        return $this->name;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
