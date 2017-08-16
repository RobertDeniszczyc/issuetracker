<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    /**
     * Get the projects associated with the user
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    /**
     * Get the issues associated with the user
     */
    public function issues()
    {
        return $this->hasMany('App\Issue');
    }

    /**
     * Get the issue statuses associated with the user
     */
    public function issueStatuses()
    {
        return $this->hasMany('App\IssueStatus');
    }

    /**
     * Get the issue types associated with the user
     */
    public function issueTypes()
    {
        return $this->hasMany('App\IssueType');
    }
}
