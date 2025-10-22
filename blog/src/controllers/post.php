<?php

require_once('src/model/post.php');
require_once('src/model/comment.php');

function post($identifier)
{
    $post = getPost($identifier);
    $comments = getComments($identifier);

    require('templates/post.php');
}
