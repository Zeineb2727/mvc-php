<?php

require_once('src/model/comment.php');

function homepage()
{
    $postRepository = new PostRepository();
    $posts = $postRepository->getPosts();

    require('templates/homepage.php');
}
