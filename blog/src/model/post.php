<?php
class Post
{
    public $identifier;
    public $title;
    public $frenchCreationDate;
    public $content;
}

class PostRepository
{
    public $database = null;

    public function dbConnect()
    {
        if ($this->database === null) {
            $this->database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
        }
        return $this->database;
    }

    public function getPost($identifier)
    {
        $database = $this->dbConnect();
        $statement = $database->prepare(
            "SELECT id, title, content, 
            DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date 
            FROM posts 
            WHERE id = ?"
        );
        $statement->execute([$identifier]);
        $row = $statement->fetch();

        if (!$row) {
            return null;
        }

        $post = new Post();
        $post->identifier = $row['id'];
        $post->title = $row['title'];
        $post->frenchCreationDate = $row['french_creation_date'];
        $post->content = $row['content'];

        return $post;
    }

    public function getPosts()
    {
        $database = $this->dbConnect();
        $statement = $database->query(
            "SELECT id, title, content, 
            DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date 
            FROM posts 
            ORDER BY creation_date DESC"
        );

        $posts = [];
        while ($row = $statement->fetch()) {
            $post = new Post();
            $post->identifier = $row['id'];
            $post->title = $row['title'];
            $post->frenchCreationDate = $row['french_creation_date'];
            $post->content = $row['content'];
            $posts[] = $post;
        }

        return $posts;
    }
}



