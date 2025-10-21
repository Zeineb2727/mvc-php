<?php
require('src/model.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $identifier = $_GET['id'];
} else {
    echo 'Erreur :aucunidentifiantdebilletenvoyé';
    die;
}

$post = getPost($identifier);
$comments = getComments($identifier);

require('templates/post.php');