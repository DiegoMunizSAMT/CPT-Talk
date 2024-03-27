<?php
class Anime {
    private $id;
    private $title;
    private $type;
    private $year;
    private $img_url;

    // Constructor
    public function __construct($id, $title, $type, $year, $img_url) {
        $this->id = $id;
        $this->title = $title;
        $this->type = $type;
        $this->year = $year;
        $this->img_url = $img_url;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getType() {
        return $this->type;
    }

    public function getYear() {
        return $this->year;
    }

    public function getImgUrl() {
        return $this->img_url;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setYear($year) {
        $this->year = $year;
    }

    public function setImgUrl($img_url) {
        $this->img_url = $img_url;
    }
}