<?php

require_once('src/model/comment.php');

function homepage()
{
    $posts = getPosts();

    require('templates/homepage.php');
}
