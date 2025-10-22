<?php

require_once('src/lib/database.php');
require_once('src/model/comment.php');

function addComment($post, $input)
{
    if (empty($input['author']) || empty($input['comment'])) {
        throw new Exception('Les données du formulaire sont invalides.');
    }

    $author = $input['author'];
    $comment = $input['comment'];

    $dbConnection = new DatabaseConnection();
    $commentRepository = new CommentRepository($dbConnection);

    $success = $commentRepository->createComment($post, $author, $comment);

    if (!$success) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }

    header('Location: index.php?action=post&id=' . $post);
    exit();
}

