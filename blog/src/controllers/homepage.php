<?php
//src/controllers/homepage.php
require_once('src/lib/database.php');
require_once('src/model/post.php');
function homepage()
{
    $dbConnection = new DatabaseConnection();
    $postRepository = new PostRepository($dbConnection);
    $posts = $postRepository->getPosts();

    require('templates/homepage.php');
}
