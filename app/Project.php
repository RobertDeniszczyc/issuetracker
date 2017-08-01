<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id', 'name', 'shortcode', 'description'
    ];

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
    	$this->name = $name;
    }

    public function setShortcode($shortcode) {
    	$this->shortcode = $shortcode;
    }

    public function setDescription($description) {
    	$this->description = $description;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
    	return $this->name;
    }

    public function getShortcode() {
    	return $this->shortcode;
    }

    public function getDescription() {
    	return $this->description;
    }

}
