<?php

require_once('src/model.php');
function post($identifier)
{
    $post = getPost($identifier);
    $comments = getComments($identifier);
    require('templates/post.php');
}