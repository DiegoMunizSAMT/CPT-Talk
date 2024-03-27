<?php
class Search {
    public function index() {
        // Models
        require_once 'application/models/anime.php';
        require_once 'application/models/anime_mapper.php';

        // Views
        require_once 'application/views/search/index.php';
    }
}