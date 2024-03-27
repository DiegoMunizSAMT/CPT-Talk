<?php
require_once 'anime.php';
class AnimeMapper {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO('sqlite:'.DATABASE);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function fetchById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM anime WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Anime(
            $row['id'],
            $row['title'],
            $row['type'],
            $row['year'],
            $row['img_url']
        );
    }

    public function fetchAll() {
        $stmt = $this->pdo->query("SELECT * FROM anime");
        $animes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $animes[] = new Anime(
                $row['id'],
                $row['title'],
                $row['type'],
                $row['year'],
                $row['img_url']
            );
        }
        return $animes;
    }

    public function add(Anime $anime) {
        $stmt = $this->pdo->prepare("INSERT INTO anime (id, title, type, year, img_url) VALUES (:id, :title, :type, :year, :img_url)");
        $stmt->execute([
            'id' => $anime->getId(),
            'title' => $anime->getTitle(),
            'type' => $anime->getType(),
            'year' => $anime->getYear(),
            'img_url' => $anime->getImgUrl()
        ]);
    }

    public function update(Anime $anime) {
        $stmt = $this->pdo->prepare("UPDATE anime SET title = :title, type = :type, year = :year, img_url = :img_url WHERE id = :id");
        $stmt->execute([
            'id' => $anime->getId(),
            'title' => $anime->getTitle(),
            'type' => $anime->getType(),
            'year' => $anime->getYear(),
            'img_url' => $anime->getImgUrl()
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM anime WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}