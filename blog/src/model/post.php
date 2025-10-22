<?php
class Post
{
    public $identifier;
    public $title;
    public $frenchCreationDate;
    public $content;
}


function getPosts()
{
    $database = dbConnect();
    $statement = $database->query(
        "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date 
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

function getPost($identifier)
{
    $database = dbConnect();
    $statement = $database->prepare(
        "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date 
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

// Fonction de connexion à la base de données
function dbConnect()
{
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    return $database;
}
