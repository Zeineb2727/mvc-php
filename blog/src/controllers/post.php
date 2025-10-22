<?php

require_once('src/lib/database.php');
require_once('src/model/comment.php');
require_once('src/model/post.php');
function post($identifier)
{
    $dbConnection = new DatabaseConnection();

    $postRepository = new PostRepository($dbConnection);
    $commentRepository = new CommentRepository($dbConnection);

    // Récupération des données
    $post = $postRepository->getPost($identifier);
    $comments = $commentRepository->getComments($identifier);

    require('templates/post.php');
}